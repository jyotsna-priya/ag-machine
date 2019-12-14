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
  /*input[type=radio]{
  transform:scale(1.5);
  }*/
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
        <span class="icon-bar">inside icon bar1</span>
        <span class="icon-bar">inside icon bar2</span>
        <span class="icon-bar">inside icon bar3</span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="solutions.php">Solutions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
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
                <h3><strong>A list of sensors available on this edge station</strong></h3>
            </div>
            <div class="panel-body">
                <h4>Select 'Add' if you want to add the sensor to the edge station, 'Delete' if you want to remove it, and 'Repair' if the sensor is going under maintenance.</h4>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
            <div class="table-responsive">          
                    <table class="table table-striped">
                        <thead style="text-align:center">
                            <tr>
                            <th>Sensor Type</th>
                            <th>Add</th>
                            <th>Delete</th>
                            <th>Repair</th>
                            </tr>
                        </thead>
			<tbody>
			<form method="post", action="">
                        <?php
                        	if (isset($_SESSION['sensors'])) {
                            		$sensor_list = array();
                            		foreach ($_SESSION['sensors'] as $value) {
                              			$sensor_list[$value[0]] = "";
                        ?>	
                        <tr>
                        	<td><div align="center"><?php echo ucfirst($value[0]) ?></div></td>
				<td><div align="center"><input type="radio" name="<?php echo $value[0] ?>" value="Add" <?php if ($value[2] == 'Configured') echo 'checked' ?>> </div></td>
                            	<td><div align="center"><input type="radio" name="<?php echo $value[0] ?>" value="Delete" <?php if ($value[2] == 'Not Configured') echo 'checked' ?>> </div></td>
                            	<td><div align="center"><input type="radio" name="<?php echo $value[0] ?>" value="Repair" <?php if ($value[2] == 'Maintenance') echo 'checked' ?>> </div></td>
                        </tr>
                        <?php
                              		}
                            	}
                        ?>
                          <input type="submit" name='addDeleteRepair' style="font-face: 'Comic Sans MS'; font-size: larger; color: white; background-color: green;" value="Save Changes">
			  </form>
			<?php
				if (isset($_POST['addDeleteRepair']))
                                {
                                    foreach ($sensor_list as $key => $value) {
                                      if(isset($_POST[$key]))
                                        $sensor_list[$key]=$_POST[$key];
                                    }
                                }
			?>
                        </tbody>
                    </table>
		<?php
			$conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
			if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
			}
			$sensor_list["location"] = $_SESSION['city'];
			if (isset($_SESSION['edgestation_name']))
			    $sensor_list["thingname"] = $_SESSION['edgestation_name'];
			else
			    echo "Edgestation not selected!";
			//print_r($sensor_list);
                        $sensor_list_json = json_encode($sensor_list);
			$url = "http://54.161.132.160:5555/configure_edgestation";
                        $response = http($url, $sensor_list_json, 'put');
                        function http($url,$data=[],$method='put'){
			    $ch = curl_init();
                            $chOpts = [
                                CURLOPT_SSL_VERIFYPEER=>false,
                                CURLOPT_HEADER=>false,
                                CURLOPT_FOLLOWLOCATION=>true,
                                CURLOPT_RETURNTRANSFER=>true,
                                CURLOPT_CONNECTTIMEOUT =>8,
                                CURLOPT_TIMEOUT => 16,
                            ];
			    $chOpts[CURLOPT_CUSTOMREQUEST]="PUT";    
			    $chOpts[CURLOPT_POSTFIELDS]=$data;
                            $chOpts[CURLOPT_URL]=$url;
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                            //echo 'Request: '.$method.'['.$url.']'."\n";
                            //print_r($data);
                            curl_setopt_array($ch, $chOpts);
			    $res = curl_exec($ch);
                            if($res === false)
                            {
                                echo 'Curl error: ' . curl_error($ch);
                            }
                            curl_close($ch);
                            return $res;
			}
			//$conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
			$edgestation_id = $_SESSION['edgestation_id'];
			// Check connection
                        //if ($conn->connect_error) {
                        //	die("Connection failed: " . $conn->connect_error);
                        //}
			foreach ($sensor_list as $key => $value) {
			    if ($value == "Add") {
                                $sql = "UPDATE sensors SET sensor_status = 'Configured' WHERE sensor_type = '$key' AND edgestation_id = $edgestation_id";
                                $result = $conn->query($sql);
                            }
                            else if ($value == "Delete") {
                                $sql = "UPDATE sensors SET sensor_status = 'Not Configured' WHERE sensor_type = '$key' AND edgestation_id = $edgestation_id";
                                $result = $conn->query($sql);
                            }
                            else if ($value == "Repair") {
                                $sql = "UPDATE sensors SET sensor_status = 'Maintenance' WHERE sensor_type = '$key' AND edgestation_id = $edgestation_id";
                                $result = $conn->query($sql);
			    }
			}
			$conn->close();
                    ?>
            </div>
        </div>
                
    </div>
</div>

<div>
    <button type="button" class="btn btn-success" onclick="window.location.href = 'sensors.php'">Go Back</button>
    <button type="button" class="btn btn-success" onclick="window.location.href = 'view_data.php'">View Sensor Data</button>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

</body>
</html>
