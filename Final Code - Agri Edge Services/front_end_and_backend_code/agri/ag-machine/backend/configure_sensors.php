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
        <li class="active"><a href="#">Home</a></li>
        <li><a href="solutions.php">Solutions</a></li>
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
                            <th>Sensor ID</th>
                            <th>Add</th>
                            <th>Delete</th>
                            <th>Repair</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (isset($_SESSION['sensors'])) {
                                    $array_val = array();
                                    $add = "add";
                                    $delete = "delete";
                                    $repair = "repair";
                                    foreach ($_SESSION['sensors'] as $value) {
                                        array_push($array_val, $value[1]);
                                    }
                                }
                            ?>
                            <tr>
                            <form method="post" action="">
                            <td>Temperature</td>
                            <td><?php echo $array_val[0]; ?></td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='temperature' value='Add' checked>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='temperature' value='Delete'>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='temperature' value='Repair'>
                                </label></td>
                            <td>
                            </tr>
                            <tr>
                            <td>Humidity</td>
                            <td><?php echo $array_val[0]; ?></td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='humidity' value='Add' checked>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='humidity' value='Delete'>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='humidity' value='Repair'>
                                </label></td>
                            <td>
                            </tr>
                            <tr>
                            <td>Rainfall</td>
                            <td><?php echo $array_val[0]; ?></td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='precipProbability' value='Add' checked>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='precipProbability' value='Delete'>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='precipProbability' value='Repair'>
                                </label></td>
                            <td>
                            </tr>
                            <tr>
                            <td>GPS</td>
                            <td><?php echo $array_val[0]; ?></td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='gps' value='Add' checked>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='gps' value='Delete'>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='gps' value='Repair'>
                                </label></td>
                            <td>
                            </tr>
                            <tr>
                            <td>Speed</td>
                            <td><?php echo $array_val[0]; ?></td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='windSpeed' value='Add' checked>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='windSpeed' value='Delete'>
                                </label>
                            </td>
                            <td>
                                <label class='radio-inline'>
                                <input type='radio' name='windSpeed' value='Repair'>
                                </label></td>
                            <td>
                            </tr>
                            <tr>
                            <input type="submit" name='addDeleteRepair' style="font-face: 'Comic Sans MS'; font-size: larger; color: white; background-color: green;" value="Save Changes">
                            </tr>
                        </form>
                        </tbody>
                    </table>
                    <?php
                        $sensor_list = array("temperature"=>"", "humidity"=>"", "precipProbability"=>"", "gps"=>"", "windSpeed"=>"");
                        if (isset($_POST['addDeleteRepair']))
                        {
                            if(isset($_POST['temperature']))
                                $sensor_list['temperature']=$_POST['temperature'];
                            if(isset($_POST['humidity']))
                                $sensor_list['humidity']=$_POST['humidity'];
                            if(isset($_POST['precipProbability']))
                                $sensor_list['precipProbability']=$_POST['precipProbability'];
                            if(isset($_POST['gps']))
                                $sensor_list['gps']=$_POST['gps']; 
                            if(isset($_POST['windSpeed']))
                                $sensor_list['windSpeed']=$_POST['windSpeed'];
                            $sensor_list_json = json_encode($sensor_list);
			    //print_r($sensor_list);
			    $fp = fopen("input.txt","w");
			    fwrite($fp,$sensor_list_json);
			    fclose($fp);
			    $url = "https://localhost:5555/configure_edgestation";
                            $response = http($url, [],'put');
                        }
                        //$url = "https://localhost:5555/configure_edgestation";
                        //$response = http($url, [],'put');
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
                            if($method=='put'){
                                //$chOpts[CURLOPT_PUT]=true;
				$chOpts[CURLOPT_CUSTOMREQUEST]="PUT";    
				$chOpts[CURLOPT_POSTFIELDS]=$data;
                                $chOpts[CURLOPT_URL]=$url;
                            }
                            else{
                                $url.='?'.is_array($data)?http_build_query($data):$data;
                                $chOpts[CURLOPT_URL]=$url;
                            }
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                            //echo 'Request: '.$method.'['.$url.']'."\n";
                            //print_r($data);
                            curl_setopt_array($ch, $chOpts);
                            if(curl_exec($ch) === false)
                            {
                                echo 'Curl error: ' . curl_error($ch);
                            }
                            $res = curl_exec($ch);
                            curl_close($ch);
                            return $res;
                        }
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
