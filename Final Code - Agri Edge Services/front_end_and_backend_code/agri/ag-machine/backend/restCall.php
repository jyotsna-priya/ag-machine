<?php
$url = "https://localhost:5555/get_sensor_data";

$response = http($url,[],'get');
$jsonArray = json_decode($response,true);
$temperature = $jsonArray["temperature"];
$edge_station_id = $jsonArray[""];
$humidity = $jsonArray["humidity"];
$precipProbability = $jsonArray["precipProbability"];
$windSpeed = $jsonArray["windSpeed"];
$gps = $jsonArray["gps"];

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
        $chOpts[CURLOPT_PUT]=true;
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
<!DOCTYPE html>
<html>
<head>
<style>
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

<h2>HTML Table</h2>

<table>
  <tr>
    <th>Sensor Name</th>
    <th>Sensor Data</th>
  </tr>
  <tr>
    <td>Temperature</td>
    <td>
        <?php
            echo $temperature;
        ?>
    </td>
  </tr>
  <tr>
    <td>Humidity</td>
    <td>
        <?php
            echo $humidity;
        ?>
    </td>
  </tr>
  <tr>
    <td>Rain</td>
    <td>
        <?php
            echo $precipProbability;
        ?>
    </td>
  </tr>
  <tr>
    <td>Windspeed</td>
    <td>
        <?php
            echo $windSpeed;
        ?>
    </td>
  </tr>
  <tr>
    <td>GPS</td>
    <td>
        <?php
            echo $gps;
        ?>
    </td>
  </tr>
</table>

</body>
</html>
