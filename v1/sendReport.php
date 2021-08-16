<?php
require_once '../includes/arduinoOperations.php';
$response = array();

$operation = new ArduinoOperations();
if(isset($_GET['license'])) $license=$_GET['license'];
else echo "is not set ..! ";
$operation->sendReport($_GET['license'],$_GET['deviceId'],$_GET['longtitude'],$_GET['latitude']);