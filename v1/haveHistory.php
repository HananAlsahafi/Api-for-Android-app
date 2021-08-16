<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $db = new DbOperations();

    if($db->isUserHaveHistory($_POST['userId'])){
        $response['have']="Yes";
        $response ['error'] = false;
     $response['message']="";
       }
       else {
        $response['have']="No";
        $response ['error'] = false;
     $response['message']="You have not medical history , please fill it";
       }
    }   
    else {
     $response ['error'] = true;
     $response ['message']= "Invalid Request";
    }
    
    echo json_encode($response);
    