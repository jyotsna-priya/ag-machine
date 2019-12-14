<?php
if(isset($_POST)&&$_POST){
  //echo "inside post";
  //print_r($_POST['total']);
  $total_amt=$_POST['total'];
 // print_r($_POST['purchase']);
 // print_r($_POST['mcType']);
  $isPurchased = $_POST['purchase'];
  $farmerId=$_POST['farmerId'];
//  echo $farmerId;
  $mcType = $_POST['mcType'];
  if($isPurchased == "yes"){
     $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT * from edgestation  where rented='0' LIMIT 1";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

   if ($result->num_rows > 0) 
   {
 //     echo "row fetched";
   //   echo $row["edgestation_id"];
     $edgestationid = $row["edgestation_id"];
   // echo $edgestationid;
   $sql_p = "INSERT INTO Pricing (machine_type,total_amount,edgestation_id) values('$mcType','$total_amt','$edgestationid')";
      if( !mysqli_query($conn,$sql_p)){
     // echo "inside if";
      echo("Error:".mysqli_error($conn));
      }
     else{
          echo "Purchased!";
    }
    $sqlu1   = "UPDATE farmers set edgestation_id='$edgestationid' where farmer_id = '$farmerId'";
                                       
    if( !mysqli_query($conn,$sqlu1)){
     //echo "inside if";
    echo("Error:".mysqli_error($conn));
    }
 else{
    echo "Purchased";
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
              echo"Crew Team Assigned"; 
             }
        }
        else{
          echo "No Crew Team AVAILABLE";
        }


  }
  else{
    echo " No machines AVAILABLE";
  }

}
}
else{
  echo json_encode(array('success'=>0));
}

