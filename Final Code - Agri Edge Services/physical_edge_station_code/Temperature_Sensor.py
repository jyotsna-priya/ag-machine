#!/usr/bin/python
# Copyright (c) 2014 Adafruit Industries
# Author: Tony DiCola

# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:

# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.

# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.

import Adafruit_DHT

sensor_id = 'temperaturesensor1'
sensor = Adafruit_DHT.DHT22
pin = 4

def get_data():
    humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
    # Convert the temperature to Fahrenheit.
    tempFahrenheit = (temperature * 9/5.0) + 32
    
    # Get measurements up to 2 decimal places
    temperature = float("{0:.1f}".format(temperature))
    tempFahrenheit = float("{0:.1f}".format(tempFahrenheit))
    humidity = float("{0:.1f}".format(humidity))
   
   
    print ("TempC: " + str(temperature))
    print ("TempF: " + str(tempFahrenheit))
    print ("Humidity: " + str(humidity))
    # Note that sometimes you won't get a reading and
    # the results will be null (because Linux can't
    # guarantee the timing of calls to read the sensor).
    # If this happens try again!
    
    return [tempFahrenheit, humidity]



