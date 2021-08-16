<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['type']) and
    isset($_POST ['latitude']) and
    isset($_POST ['longitude'])and
	isset($_POST ['userId']))
	
    {
     $db = new DbOperations();
    if($db->createSOS(
     $_POST['type'],
     $_POST ['latitude'],
     $_POST ['longitude'],
	 $_POST['userId'])){
		 
		$response['error']=false;
        $response['message']="Report is succesfully sending ";		
	 }else{
     $response['error']=true;
        $response['message']="Some error ocurred plaese try again  ";	
    
    }
   
}else{
	$response ['error'] = true;
 $response ['message']= "You are not registerd user ";
	
}}
else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}

echo json_encode($response);
