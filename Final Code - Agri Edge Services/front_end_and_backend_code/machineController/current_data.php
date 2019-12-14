<?php
session_start();
//print_r($_SESSION['sensors']);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
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
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="solutions.php">Solutions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
                $location = "37.335480, -121.893028";
                function http($url,$data=[],$method='get'){
                        $ch = curl_init();
                        $chOpts = [
                        CURLOPT_SSL_VERIFYPEER=>false,
                        CURLOPT_HEADER=>false,
                        CURLOPT_FOLLOWLOCATION=>true,
                        CURLOPT_RETURNTRANSFER=>true,
                        CURLOPT_CONNECTTIMEOUT =>8,
                        CURLOPT_TIMEOUT => 16,
                        CURLOPT_HTTPHEADER,[
                            'Content-Type: application/json'
                        ]
                    ];
                    $url.='?'.is_array($data)?http_build_query($data):$data;
                    $chOpts[CURLOPT_URL]=$url;
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt_array($ch, $chOpts);
                    $res = curl_exec($ch);
                    if($res === false)
                    {
                        echo 'Curl error: ' . curl_error($ch);
                    }
                    curl_close($ch);
                    return $res;
                }
                if (isset($_SESSION['edgestation_name']))
                    $edgestation_name = $_SESSION['edgestation_name'];
                else
                    echo "Edgestation not selected!";
                $url = "http://54.161.132.160:5555/get_sensor_data?";
                $data_arr = array("thingname"=>$edgestation_name);
                $response = http($url,$data_arr,'get');
		$jsonArray = json_decode($response,true);
		$location = $jsonArray['gps'];
		$location = str_replace(" ", ", ", $location);
?>
<div class="container">
  <div class="panel panel-default">
  <iframe src="http://maps.google.com/maps?q=<?php echo $location ?>&z=15&output=embed" width="1200px" height="350px" frameborder="0" style="border:0"></iframe>
  </div>
</div>
<div class="container text-center">    
    <div class="container">
        <h2><strong>Smart AG Machines</strong></h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Select the timestamp of the data you want to view</h4>
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
	      <table class="table">
	      	<thead>
	      		<tr>
              		<th>Sensor Type</th>
                        <th>Data Value</th>
                        </tr>
                 </thead>
                 <tbody>
	      <?php
		//$sensor_list["location"] = "38.8267 -123.4233";
		foreach ($jsonArray as $key=>$value) {
			if ($value != "NA" && $key!="edge_station_id" && $key!="timestamp") {
				echo "<tr><td>";
                    		echo ucfirst($key);
                    		echo "</td><td>";
                    		echo $value;
                    		echo "</td></tr>";
			}
			if ($key == "timestamp")
				$timestmp = $value;
		}
              ?>
                </tbody>
	      </table>
	    </div>
		<div class="panel panel-default">
		<?php echo "Time:" . $timestmp; ?>
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
