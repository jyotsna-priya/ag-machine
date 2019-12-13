import mysql.connector as mysql


# Connect to local database
mysql_connection = mysql.connect(host = "localhost", user = "root", password = "gorda1", autocommit=True)
cursor = mysql_connection.cursor(buffered=True)

# Check Databases
cursor.execute("SHOW DATABASES")
results = cursor.fetchall()

# Check if db exists
db_exists = 0
for x in results:
    if x == (u'edge_station_db',):
         db_exists = 1

if db_exists == 0:
     cursor.execute("CREATE DATABASE edge_station_db")
    
cursor.execute("USE edge_station_db")