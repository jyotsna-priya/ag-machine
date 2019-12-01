from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTShadowClient
import logging
import time
import json
import argparse
import sqlite3
import re
import os
import subprocess

# Custom Shadow callback
def customShadowCallback_Update(payload, responseStatus, token):
    # payload is a JSON string ready to be parsed using json.loads(...)
    # in both Py2.x and Py3.x
    if responseStatus == "timeout":
        print("Update request " + token + " time out!")
    if responseStatus == "accepted":
        payloadDict = json.loads(payload)
        print("~~~~~~~~~~~~~~~~~~~~~~~")
        print("Update request with token: " + token + " accepted!")
        print("property: " + str(payloadDict["state"]["desired"]["property"]))
        print("~~~~~~~~~~~~~~~~~~~~~~~\n\n")
    if responseStatus == "rejected":
        print("Update request " + token + " rejected!")

def customShadowCallback_Delete(payload, responseStatus, token):
    if responseStatus == "timeout":
        print("Delete request " + token + " time out!")
    if responseStatus == "accepted":
        print("~~~~~~~~~~~~~~~~~~~~~~~")
        print("Delete request with token: " + token + " accepted!")
        print("~~~~~~~~~~~~~~~~~~~~~~~\n\n")
    if responseStatus == "rejected":
        print("Delete request " + token + " rejected!")

# Custom Shadow callback
def customShadowCallback_Delta(payload, responseStatus, token):
    # payload is a JSON string ready to be parsed using json.loads(...)
    # in both Py2.x and Py3.x
    print(responseStatus)
    payloadDict = json.loads(payload)
    print("++++++++DELTA++++++++++")
    print("sensor status: " + str(payloadDict["state"]["property"]["sensor_status"]))
    print("+++++++++++++++++++++++\n\n")

    sensor_status = payloadDict["state"]["property"]["sensor_status"]
    sensor_list = ""
    for sensor in sensor_status.keys():
        if sensor_status[sensor] == "Add":
            sensor_list += sensor + ","
    sensor_list = sensor_list.strip(",")
    if os.path.exists("current_sensor.txt"):
        with open("current_sensor.txt", "r") as fr:
            current_sensor_list = fr.read()
    else:
        current_sensor_list = ""
    if current_sensor_list != sensor_list:
        location = sensor_status["location"].replace(" ", ",")
        subprocess.check_call(["python3", "/home/ubuntu/edgestation/scheduleDataGeneration.py", "--sensor_list", "{}".format(sensor_list), "--location", "{}".format(location), "--edge_station_id", "{}".format(sensor_status["thingname"])])
        with open("current_sensor.txt", "w") as fw:
            fw.write(sensor_list)

# Read in command-line parameters
#parser = argparse.ArgumentParser()
#parser.add_argument("-e", "--endpoint", action="store", dest="host", help="Your AWS IoT custom endpoint")
#parser.add_argument("-r", "--rootCA", action="store", dest="rootCAPath", help="Root CA file path")
#parser.add_argument("-c", "--cert", action="store", dest="certificatePath", help="Certificate file path")
#parser.add_argument("-k", "--key", action="store", dest="privateKeyPath", help="Private key file path")
#parser.add_argument("-p", "--port", action="store", dest="port", type=int, help="Port number override")
#parser.add_argument("-w", "--websocket", action="store_true", dest="useWebsocket", default=False,
#                    help="Use MQTT over WebSocket")
#parser.add_argument("-n", "--thingName", action="store", dest="thingName", default="Bot", help="Targeted thing name")
#parser.add_argument("-id", "--clientId", action="store", dest="clientId", default="basicShadowUpdater", help="Targeted client id")

#args = parser.parse_args()
host = "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com"
#rootCAPath = args.rootCAPath
rootCAPath = "/home/ubuntu/edgestation/AmazonRootCA1.pem"
#useWebsocket = "-w"
thingName = "edge_station1"
clientId = "edge_station1Client"
port = 443

# Configure logging
logger = logging.getLogger("AWSIoTPythonSDK.core")
logger.setLevel(logging.DEBUG)
streamHandler = logging.StreamHandler()
formatter = logging.Formatter('%(asctime)s - %(name)s - %(levelname)s - %(message)s')
streamHandler.setFormatter(formatter)
logger.addHandler(streamHandler)

# Init AWSIoTMQTTShadowClient Using Websocket
myAWSIoTMQTTShadowClient = None
myAWSIoTMQTTShadowClient = AWSIoTMQTTShadowClient(clientId, useWebsocket=True)
myAWSIoTMQTTShadowClient.configureEndpoint(host, port)
myAWSIoTMQTTShadowClient.configureCredentials(rootCAPath)

# AWSIoTMQTTShadowClient configuration
myAWSIoTMQTTShadowClient.configureAutoReconnectBackoffTime(1, 32, 20)
myAWSIoTMQTTShadowClient.configureConnectDisconnectTimeout(10)  # 10 sec
myAWSIoTMQTTShadowClient.configureMQTTOperationTimeout(5)  # 5 sec

# Connect to AWS IoT
myAWSIoTMQTTShadowClient.connect()

# Create a deviceShadow with persistent subscription
deviceShadowHandler = myAWSIoTMQTTShadowClient.createShadowHandlerWithName(thingName, True)

# Get latest data from the local DB
def getDataFromDB():
    if not os.path.exists("/home/ubuntu/sensor_data.db"):
        return ""
    sensor_list = ["timestamp","edge_station_id","temperature","humidity","gps","precipProbability","windSpeed"]
    conn = sqlite3.connect('/home/ubuntu/sensor_data.db')
    c = conn.cursor()
    c.execute("SELECT * FROM sensor")
    result = c.fetchall()[-1]
    data = dict()
    for index,sensor in enumerate(sensor_list):
        data[sensor] = result[index]
    return data

# Update shadow in a loop
while True:
    resp = getDataFromDB()
    JSONPayload = {"state": {"desired": {"property": {"sensor_data": resp}}}}
    JSONPayload = re.sub("'", "\"", str(JSONPayload))
    deviceShadowHandler.shadowUpdate(JSONPayload, customShadowCallback_Update, 5)
    deviceShadowHandler.shadowRegisterDeltaCallback(customShadowCallback_Delta)
    time.sleep(1)
