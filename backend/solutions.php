<?php
session_unset();
session_destroy();
session_regenerate_id();
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
.table th {
   text-align: center;   
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar">inside icon bar1</span>
        <span class="icon-bar">inside icon bar2</span>
        <span class="icon-bar">inside icon bar3</span>                        
      </button>
      <a class="navbar-brand" href="#">
          <!--img src="logo.jpg"-->
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
        <li class="active"><a href="#">Solutions</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Documentation</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
                  <div class="panel-heading"><strong>A list of edge stations with their corresponding regions. Please click on particular edge station for further operations.</strong></div>
                  <div class="panel-body">
                        <div class="table-responsive">          
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>County</th>
                                      <th>City</th>
                                      <th>Edge Station ID</th>
                                      <th>Action</th>
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
                                      $sql = "SELECT county, city, edgestation_id, rented FROM edgestation";
                                      $result = $conn->query($sql);
                                      if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()) {
                                        $data = array(
                                          'header' => '',
                                          'county' => $row["county"],
                                          'city' => $row["city"],
                                          'edgestation_id' => $row["edgestation_id"],
                                          'rented' => $row["rented"]
                                        );
                                        $query = http_build_query(array('edgestationdata' => $data));
                                        /*echo "<tr><td>" . $row["county"]. "</td><td>" . $row["city"] . "</td><td>"
                                      . $row["edgestation_id"]. "</td><td>" . "<a href = 'sensors.php'>Select</a>" . "</td></tr>";*/
                                        echo "<tr><td>";
                                        echo $row["county"];
                                        echo "</td><td>";
                                        echo $row["city"];
                                        echo "</td><td>";
                                        echo $row["edgestation_id"];
                                        echo "</td><td>";
                                        echo "<a href = \"sensors.php?edgestationdata=".$query."\">Select</a>";
                                        echo "</td></tr>";
                                      }
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
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

</body>
</html>
