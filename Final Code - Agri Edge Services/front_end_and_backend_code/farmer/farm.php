<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Farms</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php include "top-skeleton.php"; ?>
<?php  
  //get table data
  $counter = 0;
  $table = '';

  $sql = "SELECT farm_id, farm_address, farm_city, county, farm_zipcode
          FROM farm 
          WHERE farm_id IN
             (SELECT farm_id
              FROM farm 
              WHERE farmer_id =". $user . ")";    
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
  	$counter++;
	$table .= "<tr>
                     <td>".$counter."</td>
                     <td>".$row['farm_id']."</td>
                     <td>".$row['farm_address']."</td>
                     <td>".$row['farm_city']."</td>
                     <td>".$row['county']."</td>
                     <td>".$row['farm_zipcode']."</td>
                     <td><div class='text-center'><input type='checkbox' name='checkboxdelete[]' value='".$row['farm_id'] ."'></div></td>";

        $table .= "</tr>";
      }
  }
  else{
       $table = "<td><span>0 results</span></td>";
  }
  
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add a Farm</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Add a Farm</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <label >Address</label>
                      <input type="text" class="form-control" name="address" autofocus required>
		      <label >City</label>
                      <input type="text" class="form-control" name="city" required>
                      <label >County</label>
                      <input type="text" class="form-control" name="county" required>
                      <label >Zipcode</label>
                      <input type="text" class="form-control" name="zipcode" required>
                    </div>
                      <input class="d-none d-sm-inline-block btn btn-md btn-success shadow-md text-white" name="add" type="submit" value="Add">
                  </form>
                </div>
                       <?php 
                       //Add farms
                       if(isset($_POST['add']))
                       {
			   $sql = "SELECT farm_id FROM farm WHERE farm_address='". $_POST['address'] ."'";
                           $result = $conn->query($sql);
                           if(mysqli_num_rows($result) <= 0){
                               $sql = "INSERT INTO farm (farmer_id, farm_address, farm_city, county, farm_zipcode) VALUES (".$user.",'".$_POST['address']."','".$_POST['city']."','".$_POST['county']."',".$_POST['zipcode'].")";
                               $result = $conn->query($sql);
                               if ($result === TRUE) {
    			           echo "Successfully created a farm";
			       } else {
    			           echo "Error: Can't create a farm at this moment. Sorry for the inconvinience.";
                               }                            
                           }
                           else{
                               echo "Error: You have a farm registered with that address already.";
                           }
                       }                        
                       ?>
              </div>
            </div>
	</div>
           
            
         <!-- Content Row -->
          <div class="row">

        	  <!-- DataTables-->
        	  <div class="col-xl-12 col-lg-12">
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Farms List</h6>
               </div>
               <div class="card-body">
                <div class="table-responsive">
                 <form method="post">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Farm ID</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>County</th>
                        <th>Zip Code</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                         <th>Farm ID</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>County</th>
                        <th>Zip Code</th>                        
                        <th></th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php echo $table;?>
                    </tbody>
                  </table>
                </div>
              </div>
               <div class="col text-center">
                     <input class="d-none d-sm-inline-block btn btn-md btn-danger shadow-md text-white" name="delete" type="submit" value="Delete">
                 </form>
               </div>
                        <?php 
                       //Delete farms
                       if(isset($_POST['delete']))
                       {
                           $checkbox = $_POST['checkboxdelete'];
                           for($i=0; $i < count($checkbox); $i++){
                               $checkbox_farm_id = $checkbox[$i];
                               //echo $checkbox_farm_id;
			       $sql = "DELETE FROM farm WHERE farm_id=" . $checkbox_farm_id;
                               $result = $conn->query($sql);
                               if ($result === TRUE) {
    			           echo "Successfully deleted farm(s)";                                   
			       } else {
    			           echo "Error: Can't delete farm(s) because you have ag machine(s) in them";
                               }                               
                               
                           }
   
                       }                        
            ?>
            </div>
	 </div>

	</div>
      <!-- End of Main Content -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <?php include "bottom-skeleton.php"; ?>

</body>

</html>
