<?php
  $url = "http://54.183.70.28:5555/get_sensor_data";
 

  //Get all edge stations of farmer
  $sql = "SELECT edgestation_name FROM edgestation WHERE edgestation_id =". $_GET['id'];
  $result = $conn->query($sql);

  if (mysqli_num_rows($result) > 0) {
      $response = http($url,['thingname'=>$row['edgestation_name']],'get');
      $jsonArray = json_decode($response,true);
      $gps = $jsonArray["gps"];
      //echo $gps;
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

      $vars = explode(" ", $gps);
      $latitude = $vars[0];
      //echo $latitude;
      $longitude = $vars[1];
      //echo $longitude;
      $message = $_GET['id'];
      //echo $message;
      array_push($coor, array("latitude"=>$latitude, "longitude"=>$longitude, "message"=>$message));
    }
                        
 ?>
    
    <!-- google map will be shown here -->
    <!--<div id="gmap_canvas" style="width:100%;height:30em;">Loading map...</div>-->
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDDqPS4SKp3VRulZDus12r6W0_Ond89SvE"></script>   
    <script type="text/javascript">
                       
            var myOptions = {
                zoom: 5,
                center: new google.maps.LatLng(39.909736, -98.522109),  // centered US
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

             var map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
         
	      var infowindow = new google.maps.InfoWindow();
	         
                 var marker = new google.maps.Marker({
                          map: map,
                          position: new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
                 });
            
                 google.maps.event.addListener(marker, 'click', (function(marker) {
                  return function() {
                          infowindow.setContent(<?php echo $message ?>);
                          infowindow.open(map, marker);
                  }
                 })(marker));
             
    </script>
 <?php
 ?>
