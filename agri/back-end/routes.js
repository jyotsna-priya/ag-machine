const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const connection = mysql.createPool({
  host     : 'ec2-54-161-132-160.compute-1.amazonaws.com',
  user     : 'ag-machine',
  password : 'password123',
  database : 'agmachinedb'
});

// Starting our app.
const app = express();


app.get('/table', function (req, res) {
    // Connecting to the database.
    connection.getConnection(function (err, conn) {
        if(err) throw err;
    // Executing the MySQL query (select all data from the 'users' table).
    conn.query('SHOW TABLES', function (error, results, fields) {
      // If some error occurs, we throw an error.
      if (error) throw error;

      // Getting the 'response' from the database and sending it to our route. This is were the data is.
      res.send(results)
      conn.release()
    });
  });
});

// Creating a GET route that returns data from the 'users' table.
app.get('/edge', function (req, res) {
    // Connecting to the database.
    connection.getConnection(function (err, conn) {
        if(err) throw err;
    // Executing the MySQL query (select all data from the 'users' table).
    conn.query('SELECT * FROM edgestation', function (error, results, fields) {
      // If some error occurs, we throw an error.
      if (error) throw error;

      // Getting the 'response' from the database and sending it to our route. This is were the data is.
      res.send(results)
      conn.release()
    });
  });
});

app.get('/users', function (req, res) {
  // Connecting to the database.
  connection.getConnection(function (err, conn) {
      if(err) throw err;
  // Executing the MySQL query (select all data from the 'users' table).
  conn.query('SELECT * FROM users', function (error, results, fields) {
    // If some error occurs, we throw an error.
    if (error) throw error;

    // Getting the 'response' from the database and sending it to our route. This is were the data is.
    res.send(results)
    conn.release()
  });
});
});

app.post('/auth', function (req, res) {
  var username = req.headers.username
  var password = req.headers.password
  if(username && password)
  {
    connection.query('SELECT * FROM users WHERE user_name = ? AND pswd = ?',[username,password], function (error, results, fields) {
      if(results.length>0){
        res.send(results)
      }else{
        res.send('Incorrect Username and/or Password.')
      }
      res.end();
      if (error) 
        throw error;
    });
  }
  else{
    res.send('Please enter Username and Password.')
    res.end()
  }
  
});

app.get('/sensors', function (req, res) {
  // Connecting to the database.
  connection.getConnection(function (err, conn) {
      if(err) throw err;
  // Executing the MySQL query (select all data from the 'users' table).
  conn.query('SELECT * FROM sensors', function (error, results, fields) {
    // If some error occurs, we throw an error.
    if (error) throw error;

    // Getting the 'response' from the database and sending it to our route. This is were the data is.
    res.send(results)
    conn.release()
  });
});
});

app.get('/price', function (req, res) {
  // Connecting to the database.
  connection.getConnection(function (err, conn) {
      if(err) throw err;
  // Executing the MySQL query (select all data from the 'users' table).
  conn.query('SHOW COLUMNS FROM Pricing', function (error, results, fields) {
    // If some error occurs, we throw an error.
    if (error) throw error;

    // Getting the 'response' from the database and sending it to our route. This is were the data is.
    res.send(results)
    conn.release()
  });
});
});
// Starting our server.
app.listen(3000, () => {
 console.log('listening on port 3000');
});