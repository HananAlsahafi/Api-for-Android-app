<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){
   if(
    isset($_POST['userId'])and
	isset ($_POST['phoneNumber1'])and
	isset ($_POST['phoneNumber2'])
	)
	{
	$db = new DbOperations();
	$result=$db->createContact(
      $_POST['userId'],
      $_POST['phoneNumber1'],
      $_POST['phoneNumber2']
       );
	   if($result==0){
		$user=$db->updateContact($_POST['userId'] ,  $_POST['phoneNumber1'],
      $_POST['phoneNumber2']) ;
	    $user = $db->getContact($_POST['userId']);
	  $response ['phoneNumber1'] = $user['phoneNumber1'];
	  $response ['phoneNumber2'] = $user['phoneNumber2'];
	 $response ['message']= 0;  
  $response ['error'] = false;		  
		 
	   }
	 else if($result==1){
         $response ['error'] = false;
      $user = $db->getContact($_POST['userId']);
	  $response ['phoneNumber1'] = $user['phoneNumber1'];
	  $response ['phoneNumber2'] = $user['phoneNumber2'];
	  $response ['message']= 1;	
		
	
	  
	}else{
     $response['error']=true;
        $response['message']="Some error ocurred plaese try again";	
    
    }
   
}else{
	$response ['error'] = true;
 $response ['message']= "Required field is missing ";
	
}
}else {
 $response ['error'] = true;
 $response ['message']= "Invalid Request";
}
echo json_encode($response);

	  

?>