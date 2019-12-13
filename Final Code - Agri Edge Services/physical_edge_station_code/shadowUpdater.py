from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTShadowClient
import logging
import time
import json
import argparse
import database_connection
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
    #if os.path.exists("/home/pi/Documents/actual_version_edge_station/current_sensor.txt"):
    #    with open("current_sensor.txt", "r") as fr:
    #        current_sensor_list = fr.read()
    #else:
    current_sensor_list = ""
    print(current_sensor_list)
    print(sensor_list)
    
    if current_sensor_list != sensor_list:
        print("GOIN TO MAIN")
        subprocess.check_call(["python", "/home/pi/Documents/actual_version_edge_station/main.py", "--sensor_list", "{}".format(sensor_list), "--edge_station_id", "{}".format(sensor_status["thingname"])])
        #with open("current_sensor.txt", "w") as fw:
         #   fw.write(sensor_list)

# Read in command-line parameters
#parser = argparse.ArgumentParser()
#parser.add_argument("-e", "--endpoint", action="store", dest="host", help="Your AWS IoT custom endpoint")
#parser.add_argument("-r", "--rootCA", action="store", dest="rootCAPath", help="Root CA file path")
#parser.add_argument("-c", "--cert", action="store", dest="certificatePath", help="Certificate file path")
#parser.add_argument("-p", "--port", action="store", dest="port", type=int, help="Port number override")
#parser.add_argument("-w", "--websocket", action="store_true", dest="useWebsocket", default=False,
#                    help="Use MQTT over WebSocket")
#parser.add_argument("-n", "--thingName", action="store", dest="thingName", default="Bot", help="Targeted thing name")
#parser.add_argument("-id", "--clientId", action="store", dest="clientId", default="basicShadowUpdater", help="Targeted client id")

#args = parser.parse_args()
host = "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com"
#rootCAPath = args.rootCAPath
rootCAPath = "/home/pi/Desktop/RaspberryPi_AWSIoT/AmazonRootCA1.pem"
#useWebsocket = "-w"
thingName = "raspberryPi"
clientId = "raspberryPiclient"
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

# Check if table exists
def check_table_exists():
    # Check if table exists    
    database_connection.cursor.execute("SHOW TABLES")
    results = database_connection.cursor.fetchall()
    print(results)
    table_exists = 0
    for x in results:
        if x == (u'sensors_table',):
            table_exists = 1
            return True

    if table_exists == 0:
        database_connection.cursor.execute("create table sensors_table( date_time datetime, edge_station_id VARCHAR(255) NOT NULL, temperature VARCHAR(50) NOT NULL, humidity VARCHAR(50) NOT NULL, gps VARCHAR(50) NOT NULL, windspeed VARCHAR(50) NOT NULL, rainfall VARCHAR(50) NOT NULL, PRIMARY KEY (date_time) );")
        return False
        
    
# Get latest data from the local DB
def getDataFromDB():
    sensor_list = ["date_time","edge_station_id","temperature","humidity","gps","windspeed","rainfall"]
    data = dict()
    table_exists = check_table_exists()
    if table_exists is True:
        print("tttttttttttttttttttttttttttttttttttttt")
        result = database_connection.cursor.execute("SELECT * FROM sensors_table ORDER BY date_time DESC limit 1")
        print("rrrrrrrrrrrrrrrrrrrrrrrrrrrrrr" + str(result))
        if(str(result) is not None):
            result = database_connection.cursor.fetchone()
            print("rrrrrrrrrrrrrrrrrrrrrrrrrrrrrr" + str(result))
            for index,sensor in enumerate(sensor_list):
                data[sensor] = str(result[index])
                #print(str(sensor) + ", " + str(index) + "," + str(data[sensor]))
            #print("DAAAATTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" + str(data))
    return data

# Update shadow in a loop
loopCount = 0
while True:
    resp = getDataFromDB()
    print ("RRRREEEEESSSSSPPPPP" + str(resp))
    JSONPayload = {"state": {"desired": {"property": {"sensor_data": resp}}}}
    print ("JJJAAASSSOOOONNNNNN" + str(JSONPayload))
    JSONPayload = re.sub("'", "\"", str(JSONPayload))
    print ("JJJAAASSSOOOONNNNNN" + str(JSONPayload))
    deviceShadowHandler.shadowUpdate(JSONPayload, customShadowCallback_Update, 5)
    deviceShadowHandler.shadowRegisterDeltaCallback(customShadowCallback_Delta)
    time.sleep(2)
