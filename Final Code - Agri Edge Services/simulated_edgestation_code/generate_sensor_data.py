import requests
import json
import argparse
from datetime import datetime
import pytz
import sqlite3
import subprocess

#base_url = "https://api.darksky.net/forecast/c0bf520b559fba5437c0a4fd26e45dd3/"
base_url = "https://api.darksky.net/forecast/a3e4d023a43ebe8977d6669c75ff152c/"
global_sensor_list = ["temperature", "humidity", "rainfall", "speed"]

class SensorDataGenerator():

    def __init__(self):
        pass

    def generate_sensor_data(self, edge_station_id, sensor_list, location):
        url = base_url + location
        response = requests.get(url)
        data = json.loads(response.text)

        sensor_data = dict()
        for sensor in global_sensor_list:
            sensor_data[sensor] = "NA"
        sensor_data["timestamp"] = datetime.now().astimezone(pytz.timezone('US/Pacific')).strftime("%Y-%m-%d %H:%M:%S")
        sensor_data["edge_station_id"] = edge_station_id
        location = location.replace(",", " ")
        sensor_data["gps"] = location

        for sensor in sensor_list.split(","):
            if sensor == "gps":
                continue
            if sensor == "rainfall":
                sensor_data[sensor] = data["currently"]["precipProbability"]
            elif sensor == "speed":
                sensor_data[sensor] = data["currently"]["windSpeed"]
            else:
                sensor_data[sensor] = data["currently"][sensor]
        print(sensor_data)
        conn = sqlite3.connect('sensor_data.db')
        c = conn.cursor()
        c.execute('''CREATE TABLE if not exists sensor
            (timestamp text, edge_station_id text, temperature text, humidity text, gps text,
            speed text, rainfall text)''')
        c.execute("INSERT INTO sensor VALUES ('{}','{}','{}','{}','{}','{}','{}')".format(
            sensor_data["timestamp"],
            sensor_data["edge_station_id"],
            sensor_data["temperature"],
            sensor_data["humidity"],
            sensor_data["gps"],
            sensor_data["speed"],
            sensor_data["rainfall"]))
        conn.commit()
        conn.close()

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
    parser.add_argument('--location',
                        required=True,
                        action='store',
                        help='Location of edge station')

# Start program
if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='Arguments for sensor data generation tool')
    add_args(parser)
    args = parser.parse_args()
    data_generator = SensorDataGenerator()
    data_generator.generate_sensor_data(args.edge_station_id, args.sensor_list, args.location)

