<?php
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
if(isset($_POST)&&$_POST){
  echo "inside post";
  print_r($_POST['total']);
  $total_amt=$_POST['total'];
  print_r($_POST['purchase']);
  print_r($_POST['mcType']);
  $isPurchased = $_POST['purchase'];
  $farmerId=$_POST['farmerId'];
  print_r($_POST['sensor']);
  $sensorList=json_encode($_POST['sensor']);
  echo $farmerId;
  $mcType = $_POST['mcType'];
 $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
  }
 /* $sql_main="SELECT * from farmers where farmer_id ='$farmerId'";
  $result_main = $conn->query($sql);
  $row_main = $result->fetch_assoc();
  if ($result->num_rows > 0)
   {

  if($isPurchased == "yes" && ($row_main['farm_id'] !== null)){
	  $sql_f = "SELECT * farm where farm";*/  
 	$sql = "SELECT * from edgestation  where rented='0' LIMIT 1";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

   if ($result->num_rows > 0) 
   {
      echo "row fetched";
      echo $row["edgestation_id"];
     $edgestationid = $row["edgestation_id"];
    //echo $edgestationid;
  /* $sql_p = "INSERT INTO Pricing (machine_type,total_amount,edgestation_id) values('$mcType','$total_amt','$edgestationid')";
      if( !mysqli_query($conn,$sql_p)){
      //echo "inside if";
      echo("Error:".mysqli_error($conn));
      }
     else{
          echo "Purchased!";
    }
    $sqlu1   = "UPDATE farmers set edgestation_id='$edgestationid' where farmer_id = '$farmerId'";
                                       
    if( !mysqli_query($conn,$sqlu1)){
     echo "inside if";
    echo("Error:".mysqli_error($conn));
    }
 else{
    echo "Edgestation";
  }

 $sqlu2 = "UPDATE edgestation set rented='1' where edgestation_id = '$edgestationid'";
  if( !mysqli_query($conn,$sqlu2)){
                                                
  echo("Error:".mysqli_error($conn));
  }
  else{
        echo"Edge Station rented"; 
    }

    $sqls = "SELECT * from CrowTeam where assignedStatus = 'AVAILABLE' LIMIT 1";
    $results = $conn->query($sqls);
      $rows = $results->fetch_assoc();
    if ($results->num_rows > 0) {
        $username=$rows['user_name'];
        $sqlu3   = "UPDATE CrowTeam set edgestation_id='$edgestationid', assignedStatus='ASSIGNED' where user_name='$username'";
        if( !mysqli_query($conn,$sqlu3)){
          echo("Error:".mysqli_error($conn));
        }
        else{
		echo"Crew Team Assigned";*/ 

		$account_sid = 'AC8d99347e7e6b61e57bcebfdefd91cbff';
		$auth_token = '1e00af5a248911bf836251cc998343a1';
		$twilio_number = "+12562429429";
		$client = new Client($account_sid, $auth_token);
		$msg = "'Edge Station Id:'. $edgestationid . ', Sensor List:' . '$sensorList'";
		$client->messages->create(
    		'+16692048391',
    		array(
        		'from' => $twilio_number,
        		'body' => $msg
    		)
		);	
/*        }
        }
        else{
          echo "No Crew Team AVAILABLE";
        }

 */
  }
  else{
    echo " No machines AVAILABLE";
  }
}
else{
  echo json_encode(array('success'=>0));
}

