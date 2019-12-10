 <?php
 echo "inside php";
if(isset($_POST['removeCrew'])){
  echo "inside post";
      $select = $_POST['select'];
      echo $select;
       $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
                                      // Check connection
                                      if ($conn->connect_error) {
                                      die("Connection failed: " . $conn->connect_error);
                                      }

for($i=0;$i<count($select);$i++){

$rm_id = $select[$i];
echo $select;
$sql = "DELETE FROM CrowTeam WHERE id='$rm_id'";
 if( !mysqli_query($conn,$sql)){
                
                echo("Error:".mysqli_error($conn));

            }
  else{
    echo"<script>window.location='./service.php'</script>";
  }
          
}

     
}
?>  