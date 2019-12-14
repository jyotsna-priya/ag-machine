import pymysql
import subprocess
import re

subprocess.check_call("sqlite3 -header -csv ~/sensor_data.db 'select * from sensor;' > sensor.csv", shell=True)
subprocess.check_call("sed -i 's/\"//g' sensor.csv", shell=True)
myDB = pymysql.connect(host="ec2-54-161-132-160.compute-1.amazonaws.com",user="server",passwd="password123",db="serverdb", local_infile=1)
cHandler = myDB.cursor()
sql = "LOAD DATA LOCAL INFILE '/home/ubuntu/sensor.csv' INTO TABLE sensordata FIELDS TERMINATED BY ',' IGNORE 1 LINES"
result = cHandler.execute(sql)
if result > 0:
    print("data inserted successfully on remote server")
    subprocess.check_call("rm ~/sensor_data.db", shell=True)
else:
    print("Some error occurred!")
myDB.commit()
myDB.close()

