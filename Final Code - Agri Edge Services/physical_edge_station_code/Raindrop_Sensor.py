# Raindrop sensor DO connected to GPIO18
# HIGH= no rain, LOW= rain detected
from gpiozero import InputDevice

sensor_id = 'raindropsensor1'
rain = InputDevice(18)

def get_data():
    if not rain.is_active:
        value = 1
        print("It's raining! Send 1 to database")
    else:
        value = 0
        print("It's NOT raining. Send 0 to database")
     
    return value 

    #sleep(3)
