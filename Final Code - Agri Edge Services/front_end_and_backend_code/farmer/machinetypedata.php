<?php
  session_start();
  //setting header to json
  header('Content-Type: application/json');

  //Variables
  if(isset($_SESSION['farmerid']))
      $user = $_SESSION['farmerid'];
  
  $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  //Get machine types
  $sql = "SELECT machine_type, count(machine_type) as type_num
           FROM edgestation
           WHERE rented=1 AND farm_id IN
             (SELECT farm_id
             FROM farm 
             WHERE farmer_id =". $user . ")
           GROUP BY machine_type"; 
  $result = $conn->query($sql);
 
  //loop through the returned data
  $data = array();

  if (mysqli_num_rows($result) > 0) {	
    foreach ($result as $row) {
      $data[] = $row;
    }
  }
  else {
    $data[] = 0;
  }


  $result->close();
  $conn->close();

  //now print the data
  print json_encode($data);
?>
