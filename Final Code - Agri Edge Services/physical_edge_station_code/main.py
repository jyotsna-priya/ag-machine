from datetime import date, datetime
import Temperature_Sensor
import GPS_Sensor
import Raindrop_Sensor
import database_connection
import json
import time
import boto3
import os
import argparse

global_sensor_list = ["temperature", "humidity", "gps", "speed", "rainfall"]

class SensorDataGenerator():

    def __init__(self):
        pass

    def generate_sensor_data(self, edge_station_id, sensor_list):
        print("MMMMMMMMMAAAAAAAAAAAAAAAAAAAIIIIIIIIIIIIIIIIIINNNNNNNNNNNNNNNNNNN")
        print(edge_station_id)
        print(sensor_list)
        sensor_data = dict()
        for sensor in global_sensor_list:
            sensor_data[sensor] = "NA"
        #sensor_data["timestamp"] = time.time()
        sensor_data["edge_station_id"] = edge_station_id

        for sensor in sensor_list.split(","):
            print(sensor)

        #for sensor in sensor_list.split(","):
        print(sensor)
        if (("temperature" in sensor_list) and ("humidity" in sensor_list)):
            value = Temperature_Sensor.get_data()
            sensor_data['temperature'] = str(value[0])
            sensor_data['humidity'] = str(value[1])
            print(value)
        elif (("temperature" in sensor_list) or ("humidity" in sensor_list)):
            value = Temperature_Sensor.get_data()
            if "temperature" in sensor_list:
                sensor_data['temperature'] = str(value[0])
            if "humidity" in sensor_list: 
                sensor_data['humidity'] = str(value[1])
            print(value)
        
        if ("rainfall" in sensor_list):
            value = Raindrop_Sensor.get_data()
            sensor_data['rainfall'] = str(value)
            print(value)
            
        if (("speed" in sensor_list) and ("gps" in sensor_list)):
            value = GPS_Sensor.get_data()
            sensor_data['speed'] = str(value[2])
            sensor_data['gps'] = str(value[0])+" "+str(value[1])
            print(value)
        elif (("speed" in sensor_list) or ("gps" in sensor_list)):
            value = GPS_Sensor.get_data()
            if "speed" in sensor_list:
                sensor_data['speed'] = str(value[2])
            if "gps" in sensor_list: 
                sensor_data['gps'] = str(value[0])+" "+str(value[1])
            print(value)
                
        #print(sensor_data["edge_station_id"] + sensor_data["temperature"] + sensor_data["humidity"] + sensor_data["gps"] + sensor_data["windSpeed"] + sensor_data["precipProbability"])
        push_data_to_db(sensor_data["edge_station_id"], sensor_data["temperature"], sensor_data["humidity"], sensor_data["gps"], sensor_data["speed"], sensor_data["rainfall"])
            

def add_args(parser):
    """ Supports the command-line arguments listed below."""

    parser.add_argument('--edge_station_id',
                        required=True,
                        action='store',
                        help='Edge station ID')
    parser.add_argument('--sensor_list',
                        required=True,
                        action='store',
                        help='List of sensor data to generate')

def push_data_to_db(edge_station_id, temp, hum, gps, spd, rain):
    # Read current date and time
    now = datetime.utcnow()
    #current_time= now.strftime('%Y-%m-%d %H:%M:%S') #get current time in string format
    # Insert into db
    database_connection.cursor.execute("INSERT INTO sensors_table ( date_time, edge_station_id, temperature, humidity, gps, windspeed, rainfall) VALUES ( '"+ str(now) + "', '" + str(edge_station_id) + "', '" + str(temp) + "', '" + str(hum) + "', '" + str(gps) + "', '" + str(spd) + "', '" + str(rain) + "');")
    database_connection.mysql_connection.commit()
    database_connection.mysql_connection.close()
    
def push_bulk_data_to_remote_db():
    os.system('mysqldump -uroot -pgorda1 edge_station_db | mysql -ujanette -pjanette202 -h54.215.224.26 edge_station_db')
    database_connection.cursor.execute("DROP TABLE if exists sensors_table")

# Start program
if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='Arguments for sensor data generation tool')
    add_args(parser)
    args = parser.parse_args()
    data_generator = SensorDataGenerator()
    data_generator.generate_sensor_data(args.edge_station_id, args.sensor_list)