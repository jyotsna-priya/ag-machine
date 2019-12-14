#APIs
from flask import Flask
from flask import jsonify
from flask import request
import subprocess
import json
import boto3

client = boto3.client('iot')

app = Flask(__name__)


@app.route('/add_iot_thing', methods=['GET'])
def create_thing():
    #create thing
    response_client = client.create_thing(
        thingName = request.args.get("thingname"),
   	thingTypeName='EdgeStation',
    	attributePayload={
      	    'attributes': {
      	    },
      	    'merge': True
   	    },
   	billingGroupName='billingGroup1'
    )


    #attach certificate
    response_cert = client.attach_thing_principal(
        thingName=request.args.get("thingname"),
        principal= 'arn:aws:iot:us-east-1:797337335360:cert/657ad1a53f5076ec45b7859a056ba3599592908afb22cfeb7f0eb23ebcf5400e'
    )

    return "Edge Station added."

if __name__ == "__main__":
    app.run(host='0.0.0.0',
            port=5555,
            debug=True,
            use_reloader=False,
            threaded=True)
