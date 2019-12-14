<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AG-Machine Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  .table th {
   text-align: center;   
    }
    .navbar-brand {
    /*position: relative;*/
    background: url(logo.png);
    /*width: 7px;
    left: 15px;*/
    /*display:flex;*/
    height: 2em;
    width: 2em;
    background-size: contain;
}
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="solutions.php">Solutions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
            <img src="tractor.jpg" alt="tractor_image" style="height: 400px; width: 1200px">
        <div class="carousel-caption">
          <!--h3>AG Machine Tractors.</h3-->
          <!--p>AG Machine Tractors</p-->
        </div>      
      </div>

      <div class="item">
        <img src="drone.jpg" alt="drone_image" style="height: 400px; width: 1200px">
        <div class="carousel-caption">
          <!--h3>More Sell $</h3-->
          <!--p>AG Machine Drones</p-->
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
    <div class="container">
        <h2>Smart AG Machines</h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
			if (isset($_GET['edgestationdata'])) {
                          $edgestationdata = $_GET['edgestationdata'];
                          $edgestation_id = $edgestationdata['edgestation_id'];
                          $machine_type = $edgestationdata['machine_type'];
                          $city = $edgestationdata['city'];
			  $rented = $edgestationdata['rented'];
			  $edgestation_name = $edgestationdata['edgestation_name'];
                          $_SESSION['machine_type'] = $machine_type;
                          $_SESSION['city'] = $city;
                          $_SESSION['edgestation_id'] = $edgestation_id;
			  $_SESSION['rented'] = $rented;
			  $_SESSION['edgestation_name'] = $edgestation_name;
                        }
                        else {
                          $machine_type = $_SESSION['machine_type'];
                          $city = $_SESSION['city'];
                          $edgestation_id = $_SESSION['edgestation_id'];
			  $rented = $_SESSION['rented'];
			  $edgestation_name = $_SESSION['edgestation_name'];
                        }	
                        echo "<strong>You are on edge station $edgestation_name in $city. The machine is of type $machine_type. Here are the details:</strong>";
                    ?>
                </div>
                  <div class="panel-body">
                        <div class="table-responsive">          
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Sensor Type</th>
                                      <th>Sensor Details</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    <tr>
                                     <?php
                                      $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
                                      // Check connection
                                      if ($conn->connect_error) {
                                      die("Connection failed: " . $conn->connect_error);
                                      }
                                      $sql = "SELECT sensor_type, sensor_details, sensor_status FROM sensors where edgestation_id=$edgestation_id";
                                      $result = $conn->query($sql);
                                      if ($result->num_rows > 0) {
                                      // output data of each row
                                      $_SESSION['sensors'] = array();
                                      while($row = $result->fetch_assoc()) {
                                          $sensor_type = $row['sensor_type'];
                                          $sensor_details = $row['sensor_details'];
                                          $sensor_status = $row['sensor_status'];
                                          $sensors = array($sensor_type, $sensor_details, $sensor_status);
                                          array_push($_SESSION['sensors'], $sensors); 
                                      	  echo "<tr><td>"; 
					  echo ucfirst($row["sensor_type"]);
					  echo "</td><td>";
					  echo ucfirst($row["sensor_details"]);
					  echo "</td><td>";
                                          echo ucfirst($row["sensor_status"]);
					  echo "</td></tr>";
                                      }
                                      echo "</table>";
                                      } else { echo "No sensors found for this edge station!"; }
                                      $conn->close();

                                     ?>
                                            
                                    </tr>
                                  </tbody>
                                </table>
                              
                  </div>
                </div>
              </div>
</div>

<div>
    <button type="button" class="btn btn-success" onclick="window.location.href = 'configure_sensors.php'">Configure or Update Sensors</button>
    <button type="button" class="btn btn-success" onclick="window.location.href = 'view_data.php'">View Sensor Data</button>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

</body>
</html>
