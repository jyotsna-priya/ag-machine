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
    endpoint = "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com"
    thingname = request.args.get("thingname")
    subprocess.check_call(["python3", "getShadowData.py", "-e", "{}".format(endpoint), "-n", "{}".format(thingname)])
    f = open("output.txt", "r")
    data = json.loads(f.read())["state"]["desired"]["property"]["sensor_data"]
    f.close()
    return data

@app.route('/configure_edgestation', methods=['PUT'])
def update_sensor():
    data = request.get_json()
    endpoint = "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com"
    #Code to send sensor list to edge station through API
    subprocess.check_call(["python3", "sendSensorList.py", "-e", "{}".format(endpoint), "-n", "{}".format(data["thingname"]), "-s", "{}".format(data)])
    return data

if __name__ == "__main__":
    app.run(host='0.0.0.0',
            port=5555,
            debug=False)
