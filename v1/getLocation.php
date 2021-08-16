<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['license'])){

   
		
     $db = new DbOperations();
	 $result = $db->getlocation($_POST['license']);
     if ($result==1){
		
		 $response ['error'] = true;
		  $response ['message']= "The device is not exist..!";  
		 
	 }else{		
       $user = $db->getlocation($_POST['license']);
	   if ($user['status']=="available"){
		 $response ['error'] = true;
		  $response ['message']= "You can not get the device location, please try another license!";  
	   }else{
		   $response ['error'] = false;
	    $response ['lat'] = $user['lat'];
	    $response ['lng'] = $user['lng'];
        $response ['license'] = $user['license']; 
        
	   $response ['message']= 0;	}
	}}
   
else{
	$response ['error'] = true;
 $response ['message']= "Required field is missing ";
	
}}
else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}

echo json_encode($response);



