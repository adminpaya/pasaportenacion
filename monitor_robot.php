<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://bot.pidepaya.com/ping',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);




$jsonobj = json_decode($response);

echo $jsonobj->message; 
echo $jsonobj->WhatsApp;
if( $jsonobj->message!="OK" || $jsonobj->WhatsApp!="CONNECTED"  ){

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.tamitut.com/amigo/usuario/insertalarma.php?cta=7300&zn=001&cd=130&sqr=3&time=1111&e=1&gp=1&t=1',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

$response = curl_exec($curl);                
    
    
}

curl_close($curl);
 
//var_dump(json_decode($jsonobj));
//echo $response;