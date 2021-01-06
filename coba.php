<?php 
session_start();
$accesskey = 'd744ccad63227f1a:4449aaf08729d6fe';
$deviceName = 'nodesatu';
$projectName = 'powermonitor';

class antares_php {
  function set_key($accesskey) {
    $this->key = $accesskey;
  }

  function get_key() {
    return $this->key;
  }

  function send($data,$deviceName,$projectName){
    $keyacc = "{$this->key}";

    $header = array(
      "X-M2M-Origin: $keyacc",
      // "X-M2M-Origin: ",
      "Content-Type: application/json;ty=4",
      "Accept: application/json"
    );

    $curl = curl_init();
    $dataSend = array(("m2m:cin") => array("con" => ($data)));
    // $dataSend = array(("m2m:cin") => array("con" => ("$sensor:$value")));
    $data_encode = json_encode($dataSend);
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/".$projectName."/".$deviceName."",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      // CURLOPT_POSTFIELDS =>"{\r\n  \"m2m:cin\": {\r\n    \"con\": \"{\\\"$sensor\\\":\\\"$value\\\"}\"\r\n  }\r\n}",
      CURLOPT_POSTFIELDS =>$data_encode,
      CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
    curl_close($curl);
  }


  function print($deviceName,$projectName){
    $keyacc = "{$this->key}";
    $header = array(
      "X-M2M-Origin: $keyacc",
      // "X-M2M-Origin: ",
      "Content-Type: application/json;ty=4",
      "Accept: application/json"
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/".$projectName."/".$deviceName."/la",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // var_dump($response);

    $someJSON = '['.$response.']';
    $someArray = json_decode($someJSON, true);

    // print_r($someArray);
    // echo $someArray[0]["m2m:cin"]["con"];

    $temp_url = $someArray[0]["m2m:cin"]["con"];
    $someJSONFix = '['.$temp_url.']';

    $someArrayFix = json_decode($someJSONFix, true);
    return $someArrayFix;
  }
}
?>
