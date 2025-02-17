<?php
session_start();
if(isset($_SESSION['uName']))
      $userName= $_SESSION['uName'];
    
?>
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

</head>

<body id="page-top">

  <!-- Hero Image -->
  <div>
  <img src="img/hero_image.png" width="100%">
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="service.php">
          <div class="sidebar-brand-text mx-3">Agri Edge</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="service.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Machine
      </div>

      <!-- Nav Item - Monitor -->
      <li class="nav-item">
        <a class="nav-link" href="#crtable">
          <i class="fas fa-eye"></i>
          <span>Crew Team Management</span>
        </a>
      </li>

      <!-- Nav Item - Manage Edge Station -->
      <li class="nav-item">
        <a class="nav-link" href="#edge">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Edge Station Management</span>
        </a>
      </li>

      <!-- Nav Item - Track -->
      <li class="nav-item">
        <a class="nav-link" href="#map">
          <i class="fas fa-fw fa-map-pin"></i>
          <span>Track</span>
        </a>
      </li>


      <!-- Divider -->
      
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            
            <!-- Nav Item - Messages -->
            

           <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userName; ?></span>
              </a>
              <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
        

           
           
           

          <!-- Content Row -->

          
         <!-- Content Row -->
        

     <!-- DataTales Example -->
    

 <div id="crtable"  class="row">
  

     <!-- Crew Team Management -->
    <div class="col-xl-12 col-lg-12">
     
           <div class="card shadow mb-4">
             <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Crew Team</h6>
             </div>
             <div class="card-body">
              <div class="table-responsive">
                 <form action="remove.php" method="post">
                 <a class="d-none d-sm-inline-block btn btn-md btn-success shadow-md text-white" href="addCrew.php">Add Member</a>
                
                 <input type="submit" class="d-none d-sm-inline-block btn btn-md btn-success shadow-md text-white" name="action" value="Remove">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Name</th>
                      <th>Status </th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      
                      <th>User Name</th>
                      <th>Status </th>
                      <th>Select</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                     <?php
                                      $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
                                      // Check connection
                                      if ($conn->connect_error) {
                                      die("Connection failed: " . $conn->connect_error);
                                      }
                                      $i=1;
                                      $sql = "SELECT id,user_name, assignedStatus FROM CrowTeam";
                                      $result = $conn->query($sql);
                                      if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()):
                                  
                                        
                                        echo "<tr><td>";
                                        echo $i;
                                        echo "</td><td>";
                                        echo $row["user_name"];
                                        echo "</td><td>";
                                        echo $row["assignedStatus"];
                                        echo "</td><td>";
                                        ?>
                                        <input type='checkbox' name='select' value='<?= $row["id"] ?>'/>
                                        <?php
                                        echo "</td></tr>";
                                        $i++;
                                      endwhile;
                                      echo "</table>";
                                      } else { echo "0 results"; }
                                      $conn->close();
                              
                                     ?>
                                     
            
                      
                    </tr>
                    
                  </tbody>
                </table>
                </form>
              </div>
            </div>
          </div>
  </div>

  </div>


  <!--Edge Station Management-->
<div id="edge"  class="row">
  

     <!--  -->
    <div class="col-xl-12 col-lg-12">

           <div class="card shadow mb-4">
             <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Edge Stations</h6>
             </div>
             <div class="card-body">
              <div class="table-responsive">
                 <a class="d-none d-sm-inline-block btn btn-md btn-success shadow-md text-white" href="addEdge.php">Add Edge Station</a><br>
 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>EdgeStation ID</th>
                      <th>EdgeStation Name</th>
                      <th>Farm ID</th>
                      <th>Status </th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                     <th>EdgeStation ID</th>
                     <th>EdgeStation Name</th>
                      <th>Farm ID</th>
                      <th>Status </th>
                      <th>Select</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                        <?php
                                      $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
                                      // Check connection
                                      if ($conn->connect_error) {
                                      die("Connection failed: " . $conn->connect_error);
                                      }
                                      $i=1;
                                      $sql = "SELECT edgestation_id,edgestation_name,farm_id,rented FROM edgestation";
                                      $result = $conn->query($sql);
                                      if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()):
                                  
                                        
                                        echo "<tr><td>";
                                        echo $i;
                                        echo "</td><td>";
                                        echo $row["edgestation_id"];
                                        echo "</td><td>";
                                        echo $row["edgestation_name"];
                                        echo "</td><td>";
                                        echo $row["farm_id"];
                                        echo "</td><td>";
                                        echo $row["rented"];
                                        echo "</td><td>";
                                        ?>
                                        <input type='checkbox' name='select' value='<?= $row["id"] ?>'/>
                                        <?php
                                        echo "</td></tr>";
                                        $i++;
                                      endwhile;
                                      echo "</table>";
                                      } else { echo "0 results"; }
                                      $conn->close();
                              
                                     ?>
                     
                    </tr>
                    
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

              <!-- Track -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Map</h6>
                </div>
                <div class="card-body" id="map">
                  <div id="gmap_canvas" style="width:100%;height:30em;">Loading map...</div>
                  <?php  include 'trackmap.php'; ?>
                </div>
              </div>
           </div>
  <div>
</div>

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
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Agri Machine 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
	  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	<form method="post" action="">
          <input type="submit"  class="btn btn-primary" name="logout" id="logout" value="Logout">
	</form>
	<?php 
              if(isset($_POST['logout'])){
                echo "<script>window.location='./index.php'</script>";
                       session_start();
                       $_SESSION["isLogged"] = "0";
              }
          ?>
	</div>
      </div>
    </div>
  </div>

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

</body>

</html>
