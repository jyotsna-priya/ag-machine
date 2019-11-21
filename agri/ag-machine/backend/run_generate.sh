crontab -l | grep -v 'generate_data.py' > cronfile
echo "* * * * * /usr/local/bin/python3 /Users/avdas/robot_ws/NCP-porting/sit_tools/generate_data.py --sensor_list $1 --location $2 --edge_station_id $3" >> cronfile
crontab -l 2>/dev/null; cat cronfile | crontab -
rm cronfile