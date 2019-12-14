<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Monitor-Edge Station</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
<?php include "top-skeleton.php"; ?>
<?php
  //get table data
  $counter = 0;
  $table = '';

  $sql = "SELECT sensor_id, sensor_type, sensor_status, sensor_details, edgestation_id 
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
      while($row = mysqli_fetch_assoc($result)){
  	$counter++;
	$table .= "<tr class='highlighted-row'>
                     <td>".$counter."</td>
		     <td>".$row['sensor_id']."</td>
                     <td>".$row['sensor_type']."</td>
                     <td>".$row['sensor_details']."</td>";

         if($row['sensor_status'] == 'Configured' || $row['sensor_status'] == 'configured')
	   $table .= "<td><span class='border border-success bg-success text-white rounded p-2'>".$row['sensor_status']."</span></td>";
	elseif($row['sensor_status'] == 'Maintenance' || $row['sensor_status'] == 'maintenance')
	   $table .= "<td><span class='border border-warning bg-warning text-white rounded p-2'>".$row['sensor_status']."</span></td>";
        elseif($row['sensor_status'] == 'Not Configured' || $row['sensor_status'] == 'not configured')
	   $table .= "<td><span class='border border-secondary bg-secondary text-white rounded p-2'>".$row['sensor_status']."</span></td>";
         
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
              <h6 class="m-0 font-weight-bold text-success">Edge Station: <?php echo $_GET['id']; ?></h6>
             </div>
             <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Sensor Id</th>
                      <th>Type</th>
                      <th>Details</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                   <th>#</th>
                      <th>Sensor Id</th>
                      <th>Type</th>
                      <th>Details</th>
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

          <!-- DataTales Example -->
	  <div class="col-xl-12 col-lg-12">
           <div class="card shadow mb-4">
             <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Edge Station Data</h6>
             </div>
             <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
	      		<tr>
              		<th>Sensor Type</th>
                        <th>Data Value</th>
                        </tr>
                 </thead>
                 <tbody>


	      <?php
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
                    $url.='?'.(is_array($data)?http_build_query($data):$data);
        	    $chOpts[CURLOPT_URL]=$url;
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
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
		$url = "http://localhost:5555/get_sensor_data";
                $data_arr = array("thingname"=>"edge_station1");
                $response = http($url,$data_arr,'get');
		$jsonArray = json_decode($response,true);
		foreach ($jsonArray as $key=>$value) {
			if ($value != "NA" && $key!="edge_station_id" && $key!="timestamp") {
				echo "<tr><td>";
                    		echo ucfirst($key);
                    		echo "</td><td>";
                    		echo $value;
                    		echo "</td></tr>";
			}
		}
              ?>

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






