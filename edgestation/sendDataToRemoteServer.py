import pymysql

myDB = pymysql.connect(host="ec2-54-161-132-160.compute-1.amazonaws.com",user="server",passwd="password123",db="serverdb", local_infile=1)
cHandler = myDB.cursor()
sql = "LOAD DATA LOCAL INFILE '/home/ubuntu/edgestation/edgedb/data-new.csv' INTO TABLE sensordata FIELDS TERMINATED BY ','"
result = cHandler.execute(sql)
if result > 0:
    print("data inserted successfully on remote server")
else:
    print("Some error occurred!")
myDB.commit()
myDB.close()
