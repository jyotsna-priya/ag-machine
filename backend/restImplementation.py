from flask import Flask
from flask import jsonify
from flask import request
import subprocess
import json

app = Flask(__name__)

@app.route('/get_sensor_data', methods=['GET'])
def get_sensor_data():
    # Code to get data from shadow

    # Get endpoint and thingname from GET param
    endpoint = request.args.get("endpoint")
    thingname = request.args.get("thingname")
    subprocess.check_call(["python3", "getShadowData.py", "-e", "{}".format(endpoint), "-n", "{}".format(thingname)])
    f = open("output.txt", "r")
    data = json.loads(f.read())["state"]["desired"]["property"]
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
    subprocess.check_call(["python3", "sendSensorList.py", "-e", "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com", "-r", "AmazonRootCA1.pem", "-w", "-id", "backend_vm", "-t", "sensorListTopic", "-M", "{}".format(message)])

if __name__ == "__main__":
    app.run(host='0.0.0.0',
            port=5555,
            debug=True,
            use_reloader=False,
            threaded=True)
