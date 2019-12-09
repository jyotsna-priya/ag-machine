<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Track</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style>
	
	.highlighted-row:hover{
	   background-color: rgba(78, 115, 223, 0.2);
        }

	.highlighted-row:active{
	   background-color: rgba(78, 115, 223, 0.4);
        }


	.table-link:link {
  	   text-decoration: none;
           color: #858796;
	}

	.table-link:visited {
  	    text-decoration: none;
            color: #858796;
	}

	.table-link:hover {
            text-decoration: none;
	    color: #858796;

	}

	.table-link:active {
            text-decoration: none;
            color: #858796;
	}
  </style>

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
	$table .= "<tr class='highlighted-row'>
                     <td>".$counter."</td>
                     <td><a class='table-link' href=http://13.52.80.181/trackedgestation.php?id=".$row['edgestation_id']."&user=". $user . "><div>".$row['edgestation_id']."</div></a></td>";

        $table .= "</tr>";
      }
  }
  else{
       $table = "<td><span>0 results</span></td>";
  }
  
?>
    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

	   <!-- DataTales Example -->
	  <div class="col-xl-12 col-lg-12">
           <div class="card shadow mb-4">
             <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">AG Machines List</h6>
             </div>
             <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Edge Station ID</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Edge Station ID</th>
                    </tr>
                  </tfoot>
                  <tbody>
                     <?php echo $table;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/bar-chart.js"></script>
  <script src="js/demo/datatables-demo.js"></script>

  
  <?php include "bottom-skeleton.php"; ?>

</body>

</html>






