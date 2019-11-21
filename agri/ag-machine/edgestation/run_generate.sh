crontab -l | grep -v 'generate_sensor_data.py' > cronfile
echo "* * * * * /usr/bin/python3 /home/ubuntu/edgestation/generate_sensor_data.py --sensor_list $1 --location $2 --edge_station_id $3" >> cronfile
crontab -l 2>/dev/null; cat cronfile | crontab -
rm cronfile
