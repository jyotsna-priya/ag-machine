<?php
  $url = "http://54.183.70.28:5555/get_sensor_data";
 

  //Get all edge stations of farmer
  $sql = "SELECT edgestation_name, edgestation_id FROM edgestation WHERE rented='1'";
             
  $result = $conn->query($sql);


  $all_machines = array();

  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        array_push($all_machines, array($row["edgestation_name"], $row["edgestation_id"]));
      }
  }
  else {
      $all_machines = array();
  } 
  
  $gps_coor = array(); 

for ($i = 0; $i < sizeof($all_machines); $i++) {
  //echo $all_machines[$i][0];
  $response = http($url,['thingname'=>$all_machines[$i][0]],'get');
  $jsonArray = json_decode($response,true);
  $gps = $jsonArray["gps"];
  //echo $gps;
  array_push($gps_coor, $gps);
}

  function http($url,$data,$method='get'){
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

        $url.='?'. (is_array($data)?http_build_query($data):$data);
        $chOpts[CURLOPT_URL]=$url;
    
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

   

  // get latitude, longitude and formatted address 
    $coor = array();
    for($k = 0; $k < sizeof($gps_coor); $k++){  
      //echo $gps_coor[$k];
      $vars = explode(" ", $gps_coor[$k]);
      $latitude = $vars[0];
      //echo $latitude;
      $longitude = $vars[1];
      //echo $longitude;
      $message = $all_machines[$k][1];
      //echo $message;
      array_push($coor, array("latitude"=>$latitude, "longitude"=>$longitude, "message"=>$message));
    }
                        
 ?>
    
    <!-- google map will be shown here -->
    <!--<div id="gmap_canvas" style="width:100%;height:30em;">Loading map...</div>-->
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDDqPS4SKp3VRulZDus12r6W0_Ond89SvE"></script>   
    <script type="text/javascript">
            var latitudes = '<?php echo implode(', ', array_map(function ($entry) {
 
                       return $entry['latitude'];
 
            }, $coor)); ?>';
            latitudes = latitudes.split(",");

            var longitudes = '<?php echo implode(', ', array_map(function ($entry) {
 
                       return $entry['longitude'];
 
            }, $coor)); ?>';
            longitudes = longitudes.split(",");

            var messages = '<?php echo implode(', ', array_map(function ($entry) {
 
                       return $entry['message'];
 
            }, $coor)); ?>';
            messages = messages.split(",");

                       
            var myOptions = {
                zoom: 5,
                center: new google.maps.LatLng(39.909736, -98.522109),  // centered US
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

             var map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
         
        var infowindow = new google.maps.InfoWindow();
        var maker, i;
             
             for (i = 0; i < messages.length ; i++) {
                 var marker = new google.maps.Marker({
                          map: map,
                          position: new google.maps.LatLng(latitudes[i], longitudes[i])
                 });
            
                 google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                          infowindow.setContent(messages[i]);
                          infowindow.open(map, marker);
                  }
                 })(marker, i));
             }
    </script>
 <?php
 ?>











