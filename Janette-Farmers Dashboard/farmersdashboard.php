<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard</title>

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

  //Variables
  $num_of_farms = 0;
  $num_of_machines = 0;
  $num_of_sensors = 0;
 
  //Get number of farms
  $sql = "SELECT farm_id FROM farm WHERE farmer_id =" . $user;
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) {
  	// Return the number of rows in result set
  	$num_of_farms=mysqli_num_rows($result);
  }
  else {
	$num_of_farms = 0;
  }

  //Get number of AG Machines
  $sql = "SELECT edgestation_id
           FROM edgestation
           WHERE rented=1 AND farm_id IN
             (SELECT farm_id
             FROM farm 
             WHERE farmer_id =". $user . ")";
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) {
  	// Return the number of rows in result set
  	$num_of_machines=mysqli_num_rows($result);
  }
  else {
	$num_of_machines = 0;
  }

  //Get number of Sensors
  $sql = "SELECT sensor_id
           FROM sensors
           WHERE edgestation_id IN
             (SELECT edgestation_id
              FROM edgestation
              WHERE farm_id IN
                (SELECT farm_id
                 FROM farm 
                 WHERE farmer_id =". $user . "))";
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) {
  	// Return the number of rows in result set
  	$num_of_sensors=mysqli_num_rows($result);
  }
  else {
	$num_of_sensors = 0;
  }

  //get table data
  $counter = 0;
  $table = '';

  $sql = "SELECT farm_id, edgestation_id, edgestation_status
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
                     <td>".$row['farm_id']."</td>
                     <td><a class='table-link' href=http://13.52.80.181/edgestation.php?id=".$row['edgestation_id']."&user=". $user . "><div>".$row['edgestation_id']."</div></a></td>";

	if($row['edgestation_status'] == 'active' || $row['edgestation_status'] == 'Active')
	   $table .= "<td><span class='border border-success bg-success text-white rounded p-2'>".$row['edgestation_status']."</span></td>";
	elseif($row['edgestation_status'] == 'maintenance' || $row['edgestation_status'] == 'Maintenance')
	   $table .= "<td><span class='border border-warning bg-warning text-white rounded p-2'>".$row['edgestation_status']."</span></td>";
        elseif($row['edgestation_status'] == 'inactive' || $row['edgestation_status'] == 'Inactive')
	   $table .= "<td><span class='border border-secondary bg-secondary text-white rounded p-2'>".$row['edgestation_status']."</span></td>";
         
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="farm.php" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-md"><i class="text-white-50"></i>FARMS</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Farms # Card-->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">Farms</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num_of_farms;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-seedling  fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- AG Machines Card-->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">AG Machines</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num_of_machines;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tractor fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sensors Card -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-info text-uppercase mb-1">Sensors</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $num_of_sensors; ?></div>
                     </div>
                     <div class="col-auto">
                       <i class="fas fa-wifi fa-2x text-gray-300"></i>
                     </div>
                   </div>
                 </div>
               </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Cost Accumulation</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bar Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">AG Machines By Type</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-bar pt-5 pb-2">
                    <canvas id="myBarChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

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
                      <th>Farm ID</th>
                      <th>Edge Station ID</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Farm ID</th>
                      <th>Edge Station ID</th>
                      <th>Status</th>
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


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Map</h6>
                </div>
                <div class="card-body">
                  <div id="gmap_canvas" style="width:100%;height:30em;">Loading map...</div>
                  <?php  include 'map.php'; ?>
                </div>
              </div>
           </div>
	<div>

              <!-- Color System 
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

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
