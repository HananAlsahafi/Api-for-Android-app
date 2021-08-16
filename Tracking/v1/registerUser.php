<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['lat']) and
    isset($_POST ['lng']) and
    isset($_POST ['license']) )
    {
		
     $db = new DbOperations();
    $result=$db->createTracking(
     $_POST['lat'],
	  $_POST ['lng'],
     $_POST ['license']);
		
		 if($result==1){
		
		
		 $response ['error'] = false;
		 $response['success']=1;
	  $response['message']="tracking is succesfully created ";
	
	
      
	}else{
     $response['error']=true;
        $response['message']="Some error ocurred plaese try again";	
    
    }
   
}else{
	$response ['error'] = true;
 $response ['message']= "Required field is missing ";
	
}}
else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}

echo json_encode($response);
