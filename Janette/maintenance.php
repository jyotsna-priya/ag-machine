<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Request Maintenace</title>

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

  $sql = "SELECT farm_id, edgestation_id
          FROM edgestation 
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
                     <td>".$row['edgestation_id']."</td>
                     <td><div class='text-center'><input type='checkbox' name='checkboxmaintenance[]' value='".$row['edgestation_id'] ."'></div></td>";

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
            <h1 class="h3 mb-0 text-gray-800">Request Maintenance of Edge Stations</h1>
          </div>
            
         <!-- Content Row -->
          <div class="row">

        	  <!-- DataTables-->
        	  <div class="col-xl-12 col-lg-12">
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Edge Stations List</h6>
               </div>
               <div class="card-body">
                <div class="table-responsive">
                 <form method="post">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Farm ID</th>
                        <th>Edge Station ID</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                         <th>Farm ID</th>
                        <th>Edge Station ID</th>                       
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
                     <input class="d-none d-sm-inline-block btn btn-md btn-primary shadow-md text-white" name="Request Maintenance" type="submit" value="Request Maintenace">
                 </form>
               </div>
                        <?php 
                       //Delete farms
                       if(isset($_POST['Request Maintenance']))
                       {
                           $checkbox = $_POST['checkboxmaintenace'];
                           for($i=0; $i < count($checkbox); $i++){
                               $checkbox_edgestation_id = $checkbox[$i];
                               //echo $checkbox_farm_id;
			       $sql = "UPDATE edgestation SET edgestation_status='Maintenance' WHERE edgestation_id=" . $checkbox_edgestation_id;
                               $result = $conn->query($sql);
                               if ($result === TRUE) {
    			           echo "Successfully requested maintenance";
			       } else {
    			           echo "Error: Can't request maintenance at this moment. Sorry for the inconvinience";
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
