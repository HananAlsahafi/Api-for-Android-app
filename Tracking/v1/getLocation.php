<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['license'])){

   
		
     $db = new DbOperations();
	
			  $response ['error'] = false;
       $user = $db->getlocation($_POST['license']);
	    $response ['lat'] = $user['lat'];
	    $response ['lng'] = $user['lng'];
        $response ['license'] = $user['license']; 
        
		 $response ['message']= 0;	
		}
   
else{
	$response ['error'] = true;
 $response ['message']= "Required field is missing ";
	
}}
else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}

echo json_encode($response);
