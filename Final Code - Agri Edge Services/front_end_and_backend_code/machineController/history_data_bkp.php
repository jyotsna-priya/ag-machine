<?php
session_start();
//print_r($_SESSION['sensors']);
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
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
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
.pager a {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
   align:center;
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
      <a class="navbar-brand" href="#">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="solutions.php">Solutions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="panel panel-default">
    <iframe src="http://maps.google.com/maps?q=37.3382, -121.8863&z=15&output=embed" width="1200px" height="350px" frameborder="0" style="border:0"></iframe>
  </div>
</div>
<div class="container text-center">    
    <div class="container">
        <h2><strong>Smart AG Machines</strong></h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Select the time of the data you want to view</h4>
                        <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Timestamp
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header">Reads data from the IoT</li>
                                <li><a href="current_data.php">View Current Data</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Reads Data from the Server Database</li>
                                <li><a href="history_data.php">View History Data</a></li>
                                </ul>
                        </div>
                </div>
                  <div class="panel-body">
                    <?php
                        if(isset($_SESSION['edgestation_id'])){
                                $edgestation_id = $_SESSION['edgestation_id'];
                                $edgestation_name = $_SESSION['edgestation_name'];
                                $city = $_SESSION['city'];
                                $rented = $_SESSION['rented'];
                                if ($rented==0)
                                    $rental_status="Not Rented";
                                else
                                    $rental_status="Rented";
                        }
                        echo "<strong>Edge Station ID:   </strong>" . $edgestation_id . '<br />';
                        echo "<strong>Location:   </strong>" . $city . '<br>';
                        echo "<strong>Rental Status:   </strong>" . $rental_status . '<br>';
                    ?>
                        
                </div>
              </div>
              <div class="panel panel-default">
                <div class="table-responsive">          
                    <table id="datePagination" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Edge Station Id</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>GPS</th>
                                <th>Speed</th>
                                <th>Rainfall</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    //$history_data = $_GET['history_data']; 
                                    $connect = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "server", "password123", "serverdb");
                                    $record_per_page = 50;
                                    $page = '';
                                    if(isset($_GET["page"]))
                                    {
                                    $page = $_GET["page"];
                                    }
                                    else
                                    {
                                    $page = 1;
                                    }
                                    $start_from = ($page-1)*$record_per_page;
                                    date_default_timezone_set('America/Los_Angeles');
                                    $date1 = date("Y-m-d H:i:s");
                                    $newdate = strtotime ( '-30 day' , strtotime ( $date1 ) ) ;
                                    $newdate = date ( 'Y-m-d H:i:s' , $newdate );
                                    $sql = "SELECT * FROM sensordata where date_time >= '".$newdate."' AND edge_station_id='".$edgestation_name."' ORDER BY date_time DESC LIMIT $start_from, $record_per_page";
                                    $result = mysqli_query($connect, $sql);
                                    // Check connection
                                    if ($connect->connect_error) {
                                    die("Connection failed: " . $connect->connect_error);
                                    }
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            // output data of each row
                                            echo "<tr><td>";
                                            echo $row["date_time"];
                                            echo "</td><td>";
                                            echo $row["edge_station_id"];
                                            echo "</td><td>";
                                            echo $row["temperature"];
                                            echo "</td><td>";
                                            echo $row["humidity"];
                                            echo "</td><td>";
                                            echo $row["gps"];
                                            echo "</td><td>";
                                            echo $row["windspeed"];
                                            echo "</td><td>";
                                            echo $row["rainfall"];
                                            echo "</td></tr>";
                                      }
                                    echo "</table>";
                                    } else { echo "0 results"; }
                                ?>         
                            </tr>
                        </tbody>
                    </table>
                    <div class="pager">
                    <?php
                    $page_query = "SELECT * FROM sensordata WHERE date_time >= '".$newdate."' AND edge_station_id='".$edgestation_name."'";
                    $page_result = mysqli_query($connect, $page_query);
                    $total_records = mysqli_num_rows($page_result);
                    $total_pages = ceil($total_records/$record_per_page);
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if($difference <= 5)
                    {
                    $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 4;
                    if($page > 1)
                    {
                    echo "<a href='$_PHP_SELF?page=1'>First</a>";
                    echo "<a href='$_PHP_SELF?page=".($page - 1)."'><<</a>";
                    }
                    for($i=$start_loop; $i<=$end_loop; $i++)
                    {     
                    echo "<a href='$_PHP_SELF?page=".$i."'>".$i."</a>";
                    }
                    if($page <= $end_loop)
                    {
                    echo "<a href='$_PHP_SELF?page=".($page + 1)."'>>></a>";
                    echo "<a href='$_PHP_SELF?page=".$total_pages."'>Last</a>";
                    }
                    $connect->close();
                    ?>
                    </div>
                    <br /><br />      
                  </div>
              </div>
              
</div>

<div>
    <button type="button" class="btn btn-success" onclick="window.location.href = 'sensors.php'">Go Back to Edge Station Page</button>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

</body>
</html>
