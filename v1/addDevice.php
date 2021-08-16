<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(isset($_POST['license']))
    {

    if (isset($_POST['status'])){
      $status = $_POST ['status'] ;
    }
    else {
       $status = "unAvailable";
    }
    $db = new DbOperations();
    $result = $db->addDevice(
    $_POST['license'] , $status);
     if($result == 1){
        $response ['error'] = false;
        $response ['message']= "Device Added successfully ..";
     }else if ($result==2){
        $response ['error'] = true;
        $response ['message']= "Some error ocurred .. try again !";
     }else if ($result==3){
      $response ['error'] = true;
      $response ['message']= "The device is already exist ..!";
   }
    
    }
    else{
        $response ['error'] = true;
        $response ['message']= "Requierd fields are missing ..!";
    }
}
else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}

echo json_encode($response);
