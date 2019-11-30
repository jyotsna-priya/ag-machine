#APIs
from flask import Flask
from flask import jsonify
from flask import request
import subprocess
import json
import boto3

client = boto3.client('iot')

app = Flask(__name__)

thingShadowName='edgestation1'

@app.route('/add_iot_thing', methods=['GET'])
def create_thing():
    #create thing
    response_client = client.create_thing(
        thingName= thingShadowName,
   	thingTypeName='EdgeStation',
    	attributePayload={
      	    'attributes': {
      	    },
      	    'merge': True
   	    },
   	billingGroupName='edge_stations_billing_group'
    )


    #attach certificate
    response_cert = client.attach_thing_principal(
        thingName='edgestation1',
   	principal='arn:aws:iot:us-west-1:225587795549:cert/cdbe9f9281761f17c48738ac05b6ffa85942d7861ccf74f3cbdb429859b938f2'
    )

    response = client.update_thing_shadow(
     	thingName= thingShadowName,     		
        payload= payload
    )


    return "Edge Station: " + thingShadowName + " added."

@app.route('/delete_iot_thing', methods=['GET'])
def delete_thing():
   
    #detach thing principal(certificate)
    response = client.detach_thing_principal(
        thingName=thingShadowName,
        principal='arn:aws:iot:us-west-1:225587795549:cert/cdbe9f9281761f17c48738ac05b6ffa85942d7861ccf74f3cbdb429859b938f2'
    )


    #list all things 
    response = client.list_things(
        nextToken='',
        maxResults=2,
        attributeName='',
        attributeValue='',
        thingTypeName='EdgeStation'
    )

    #get version of things. Search by thing name.
    x = 0
    while (x < len(response['things'])):
	if (response['things'][x]['thingName'] == thingShadowName):
		version=response['things'][x]['version']
		break
	x += 1


    #delete thing
    response = client.delete_thing(
        thingName=thingShadowName,
        expectedVersion=version
    )

    return "Edge Station: " + thingShadowName + " deleted."



def get_endpoint():
    #get endpoint
    response = client.describe_endpoint(
        endpointType='iot:Data'
    )
	
    return str(response['endpointAddress'])


@app.route('/get_sensor_data', methods=['GET'])
def get_sensor_data():
    # Get edgestation ID from GET param : testing pending
    #edge_station_id = request.args.get("edgestationid")
    # Code to get data from shadow
    subprocess.check_call(["python", "basicPubSub1.py", "-e", get_endpoint(), "-r", "RootCA1.pem", "-w", "-id", thingShadowName, "-t", "edgeStationTopic", "-m", "subscribe"])
    f = open("output.txt", "r")
    data = json.loads(f.read())["message"]
    f.close()
    return data

@app.route('/configure_edgestation', methods=['PUT'])
def update_sensor():
    f = open("input.txt", "r")
    data = json.loads(f.read())
    f.close()
    message = ""
    for sensor in data.keys():
        message += "{}:{},".format(sensor, data[sensor])
    message = message.strip(",")
    print(message)
    #Code to send sensor list to edge station through API
    subprocess.check_call(["python", "sendSensorList.py", "-e", get_endpoint(), "-r", "RootCA1.pem", "-w", "-id", thingShadowName, "-t", "sensorListTopic", "-M", "{}".format(message)])

if __name__ == "__main__":
    app.run(host='0.0.0.0',
            port=5555,
            debug=True,
            use_reloader=False,
            threaded=True)