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
$endpoint = htmlspecialchars($_POST['endpoint']);

//endpoint = ""https://southcentralus.api.cognitive.microsoft.com";
    
$url=$endpoint."/face/v1.0/detect?returnFaceId=true&returnFaceLandmarks=false&recognitionModel=recognition_01&returnRecognitionModel=false&detectionModel=detection_01";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST,TRUE);
        
echo "распознаем изображение...<br><img src=".$filepath." width='200' height='200'><br>";

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Prediction-Key: '.$key,
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
</body>
</html>

