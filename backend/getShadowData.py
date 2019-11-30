# Custom Shadow callback
def customShadowCallback(payload, responseStatus, token):
    # payload is a JSON string ready to be parsed using json.loads(...)
    # in both Py2.x and Py3.x
    print("----------------------------------------------------")
    print(responseStatus)
    payloadDict = json.loads(payload)
    print("++++++++DATA++++++++++")
    print(payload)
    print("+++++++++++++++++++++++\n\n")
    f = open("output.txt", "w")
    f.write(payload)
    f.close()

# Read in command-line parameters
parser = argparse.ArgumentParser()
parser.add_argument("-e", "--endpoint", action="store", required=True, dest="host", help="Your AWS IoT custom endpoint")
#parser.add_argument("-r", "--rootCA", action="store", required=True, dest="rootCAPath", help="Root CA file path")
#parser.add_argument("-c", "--cert", action="store", dest="certificatePath", help="Certificate file path")
#parser.add_argument("-k", "--key", action="store", dest="privateKeyPath", help="Private key file path")
#parser.add_argument("-p", "--port", action="store", dest="port", type=int, help="Port number override")
#parser.add_argument("-w", "--websocket", action="store_true", dest="useWebsocket", default=False,
#                    help="Use MQTT over WebSocket")
parser.add_argument("-n", "--thingName", action="store", dest="thingName", default="Bot", help="Targeted thing name")
#parser.add_argument("-id", "--clientId", action="store", dest="clientId", default="basicShadowDeltaListener",
#                    help="Targeted client id")

args = parser.parse_args()
#host = "a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com"
host = args.host
rootCAPath = "/var/www/html/backend/AmazonRootCA1.pem"
port = 443
#thingName = "edge_station1"
thingName = args.thingName
clientId = "backendClient"

# Configure logging
logger = logging.getLogger("AWSIoTPythonSDK.core")
logger.setLevel(logging.DEBUG)
streamHandler = logging.StreamHandler()
formatter = logging.Formatter('%(asctime)s - %(name)s - %(levelname)s - %(message)s')
streamHandler.setFormatter(formatter)
logger.addHandler(streamHandler)

# Init AWSIoTMQTTShadowClient
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

# Listen on deltas
#deviceShadowHandler.shadowRegisterDeltaCallback(customShadowCallback_Delta)

# Loop forever
#while True:
#    time.sleep(1)

#Get shadow data
deviceShadowHandler.shadowGet(customShadowCallback, 5)
deviceShadowHandler.shadowGet(customShadowCallback, 5)
