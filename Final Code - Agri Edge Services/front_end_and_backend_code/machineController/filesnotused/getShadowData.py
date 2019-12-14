from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTShadowClient

# For certificate based connection
myShadowClient = AWSIoTMQTTShadowClient("backendClient")
# For Websocket connection
#myMQTTClient = AWSIoTMQTTClient("backendClient", useWebsocket=True)
# Configurations
# For TLS mutual authentication
#myShadowClient.configureEndpoint("YOUR.ENDPOINT", 8883)
# For Websocket
myShadowClient.configureEndpoint("a3bikkrdsdyhco-ats.iot.us-east-1.amazonaws.com", 443)
# For TLS mutual authentication with TLS ALPN extension
# myShadowClient.configureEndpoint("YOUR.ENDPOINT", 443)
#myShadowClient.configureCredentials("YOUR/ROOT/CA/PATH", "PRIVATE/KEY/PATH", "CERTIFICATE/PATH")
# For Websocket, we only need to configure the root CA
myShadowClient.configureCredentials("/var/www/html/backend/AmazonRootCA1.pem")
myShadowClient.configureConnectDisconnectTimeout(10)  # 10 sec
myShadowClient.configureMQTTOperationTimeout(5)  # 5 sec

myShadowClient.connect()
# Create a device shadow instance using persistent subscription
myDeviceShadow = myShadowClient.createShadowHandlerWithName("Bot", True)
# Shadow operations
myDeviceShadow.shadowGet(customCallback, 5)
