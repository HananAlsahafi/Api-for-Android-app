<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['type']) and
    isset($_POST ['userId']) and
    isset($_POST ['incident_category']) and
    isset($_POST ['latitude'])and
	isset($_POST ['longitude']) and
    isset($_POST ['num_injured']))
    {
		
		  if(isset($_POST['comment'])){
      $comment = $_POST['comment'];
   }else {
      $comment = "0" ;
   }
		
		
     $db = new DbOperations();
    if($db->createReport(
     $_POST['type'],
     $_POST ['userId'],
     $_POST ['incident_category'],
    $_POST ['latitude'],
	$_POST ['longitude'],
	$_POST ['num_injured'],
	  $comment)){
		 
		$response['error']=false;
        $response['error']="Report is succesfully sending ";		
	 }else{
     $response['error']=true;
        $response['error']="Some error ocurred plaese try again  ";	
    
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
