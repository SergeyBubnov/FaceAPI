<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>Классификация</title>
</head>
<body>

<?php
$filepath = htmlspecialchars($_POST['filepath']);
$Server = $_SERVER['SERVER_NAME'];
$fullpath = 'https://'.$Server.'/'.$filepath;
$key = htmlspecialchars($_POST['key']);
$endpoint = htmlspecialchars($_POST['endpoint']);

//endpoint = "https://southcentralus.api.cognitive.microsoft.com";
    
$url=$endpoint."/face/v1.0/detect?returnFaceId=true&returnFaceLandmarks=false&recognitionModel=recognition_01&returnRecognitionModel=false&detectionModel=detection_01";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST,TRUE);
        
echo "распознаем изображение...<br><img src=".$filepath." width='200' height='200'><br>";

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Ocp-Apim-Subscription-Key: '.$key,
        'Content-Type: application/json'
    ));

curl_setopt($ch, CURLOPT_POSTFIELDS,"{'url' : '".$fullpath."'}" );//указываем где лежит закачанное изображение
    
curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);

$res = curl_exec($ch);
    
echo '<pre>';
$array =json_decode($res,TRUE);
print_r($array);
echo '</pre>';
curl_close($ch);
?>
 
/*
<?php

require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://southcentralus.api.cognitive.microsoft.com/face/v1.0/detect');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $key,
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
    'returnFaceId' => 'true',
    'returnFaceLandmarks' => 'false',
    'returnFaceAttributes' => '{string}',
    'recognitionModel' => 'recognition_01',
    'returnRecognitionModel' => 'false',
    'detectionModel' => 'detection_01',
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
$request->setBody("{body}");

try
{
    $response = $request->send();
    echo $response->getBody();
}
catch (HttpException $ex)
{
    echo $ex;
}

?>
 */

</body>
</html>

