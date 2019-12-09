<?php
  session_start();
  //Variables
  if(isset($_SESSION['farmerid']))
      $user = $_SESSION['farmerid'];
  $user_name = '';

  $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "server", "password123", "agmachinedb");
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  //Get User name
  $sql = "SELECT firstname_farmer, lastname_farmer FROM farmers WHERE farmer_id =" . $user;
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
        $user_name = $row["firstname_farmer"]. " " . $row["lastname_farmer"];
  }
  else {
  $user_name = '';
  } 

?>

<!-- Hero Image -->
  <div>
	<img src="img/hero_image.png" width="100%">
  </div>
  
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="farmersdashboard.php">
          <div class="sidebar-brand-text mx-3">Agri Edge</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="farmersdashboard.php">
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
        <a class="nav-link" href="monitor.php">
          <i class="fas fa-eye"></i>
          <span>Monitor</span>
        </a>
      </li>

      <!-- Nav Item - Request Maintenance -->
      <li class="nav-item">
        <a class="nav-link" href="maintenance.php">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Request Maintenance</span>
        </a>
      </li>

      <!-- Nav Item - Track -->
      <li class="nav-item">
        <a class="nav-link" href="track.php">
          <i class="fas fa-fw fa-map-pin"></i>
          <span>Track</span>
        </a>
      </li>

      <!-- Nav Item - Return -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="return-machine.php">
          <i class="fas fa-calendar-alt"></i>
          <span>Return</span>
        </a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Payment
      </div>

      <!-- Nav Item - Billing -->
      <li class="nav-item">
        <a class="nav-link" href="farmersdashboard.php">
          <i class="far fa-credit-card"></i>
          <span>Billing</span>
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


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user_name; ?></span>
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