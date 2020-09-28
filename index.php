 <?php

$server_key ="SB-Mid-server-GHlI5dlA8pPy768TMdPCCH3k";
$is_production = false;
$api_url = $is_production ? 
'https://app.midtrans.com/snap/v1/transactions'; :
 'https://app.sandbox.midtrans.com/snap/v1/transactions';

 if (!strpos($_SERVER['REQUEST_URI'],'/change')) {
     http_response_code(404);
     echo "wrong path, make sure it's '/change'";exit();
 }
  if($_SERVER['REQUEST_MOTHOD'] !== 'POST'){
    http_response_code(404);
    echo "page not found or wrong request is used";exit();

  }

  $request_body = file_get_contents('php://input');
  header('content-type: application/json');

  $charge_result = chargeAPI($api_url,$server_key,$request_body);

  http_response_code($charge_result['http_code']);
  echo $charge_result['body'];

  function chargeAPI($request_body,$server_key,$request_body){
      $ch = curl_init();
      $curl_options =array(
          CURLOPT_URL => $api_url,
          CURLOPT_RETURNTRANSFER=>1,
          CURLOPT_POST=>1,
          CURLOPT_HEADER=>0,

         CURLOPT_HTTPHEADER => array(
             'Content-Type:application/json',
             'Accept:application/json',
             'Authorization:Basic' .base64_encode($server_key . ':')

         ),
         CURLOPT_POSTFIELDS => $request_body
        );
        curl_setopt_array(
            'body'=>curl_exec($ch),
            'http_code'=>curl_getinfo(Sch,CURLINFO_HTTP_CODE),

        
        );
        return $result;


  }
   ?>