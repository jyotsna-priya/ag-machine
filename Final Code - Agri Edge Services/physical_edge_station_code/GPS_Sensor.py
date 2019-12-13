import serial
import string
import pynmea2

sensor_id = 'gpssensor1'
port = "/dev/ttyAMA0" #the serial port to which the pi is connected

#create a serial object
ser = serial.Serial(port, baudrate=9600, timeout=0.5) 

def get_data():
    termination_line = False
    speedval = 0
    latval=0
    latdirection = ""
    longval=0
    longdirection = ""
    
    while termination_line == False:
        try:
            data = ser.readline()
        except:
            print("loading")
            return [0, 0, 0]
        #print(data) 
        if data[0:6] == '$GPVTG':
            msg = pynmea2.parse(data)
            #print (msg)
            #speed
            if(msg.spd_over_grnd_kmph is None):
                speedval = 0
            else:    
                speedval = int(msg.spd_over_grnd_kmph)
            speedsymbol = msg.spd_over_grnd_kmph_sym
            concatspeed = "Speed: " + str(speedval) + " " + str(speedsymbol)
            #print (concatspeed)
        
        if data[0:6] == '$GPGGA':
            msg = pynmea2.parse(data)
            #print (msg)
            
            #latitude
            latval = msg.lat
            latdirection = msg.lat_dir
            concatlat = "Lat: " + str(latval) + " " + str(latdirection)
            #print (concatlat)
            
            #longitude
            longval = msg.lon
            longdirection = msg.lon_dir
            concatlon = "Long: " + str(longval) + " " + str(longdirection)
            #print (concatlon)
            
            if latval == '' or longval == '' :
                latval = 0
                longval = 0
            else:
                coord = convert_gps_coordinates_to_dd_format(latval, latdirection, longval, longdirection)
                latval = coord[0]
                longval = coord[1]
            
            print(str(latval )+ ", " + str(longval))
    
        if data[0:6] == '$GPGLL':
            termination_line = True
            return [latval, longval, speedval]
            
def convert_gps_coordinates_to_dd_format(latval, latdirection, longval, longdirection):
    latvaldd = latval[0:2]
    longvaldd = longval[0:3]
    latvalmm = latval[2:]
    longvalmm = longval[3:]
    
    print(latvaldd)
    print(longvaldd)
    print(latvalmm)
    print(longvalmm)
    
    latval = int(latvaldd) + (float(latvalmm) / 60)
    longval = int(longvaldd) + (float(longvalmm) / 60)
    
    if(latdirection == "S"):
        latval = latval * -1
    
    if(longdirection == "W"):
        longval = longval * -1
    
    return [latval,longval]
        