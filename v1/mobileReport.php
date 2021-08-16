<?php
require_once '../includes/arduinoOperations.php';
$response = array();

$operation = new ArduinoOperations();

if(isset($_GET['license'])) $license=$_GET['license'];
else echo "is not set ..! ";

$record=$operation->getUserInfo($license);
//$response['plateNumber']=$record['plateNumber'];
$response['phoneNumber']=$record['phoneNumber'];

echo json_encode($response['phoneNumber']);




?>