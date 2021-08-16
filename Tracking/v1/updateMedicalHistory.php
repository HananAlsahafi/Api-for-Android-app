<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['lat']) and
    isset($_POST ['lng']) and
    isset($_POST ['userId'])
	 
	
	 )
    {
   
		
     $db = new DbOperations();
    $result=$db->updateHistory(
     $_POST['lat'],
     
	  $_POST ['lng'],
  
	
		$_POST['userId']);
	
		if ($result==0){
			  $response ['error'] = true;
       $response['message']="Medical history is not updated...!  ";
		 
        
		 //$response ['message']= 0;	
		}else if($result==1){
		 
		 $response ['error'] = false;
	  $response['message']="Medical history is update. ";
	  
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
