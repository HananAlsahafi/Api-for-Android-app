<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['blood_group']) and
    isset($_POST ['blood_pressure']) and
    isset($_POST ['heart_disease'])and
	 isset($_POST ['insurance'])and
	 isset($_POST ['userId'])
	 )
    {
			  if(isset($_POST['insurance_company_name'])){
      $insurance_company_name = $_POST['insurance_company_name'];
   }else {
      $insurance_company_name = "0" ;
   }
   		  if(isset($_POST['allergies'])){
      $allergies = $_POST['allergies'];
   }else {
      $allergies = "0" ;
   }
     		  if(isset($_POST['M_detailas'])){
      $M_detailas = $_POST['M_detailas'];
   }else {
      $M_detailas = "0" ;
   }
   
    		  if(isset($_POST['ins_expire_date'])){
      $ins_expire_date = $_POST['ins_expire_date'];
   }else {
      $ins_expire_date = "0" ;
   }
   
     		  if(isset($_POST['membership_num'])){
      $membership_num = $_POST['membership_num'];
   }else {
      $membership_num = "0" ;
   }
   
		
     $db = new DbOperations();
    $result=$db->updateHistory(
     $_POST['blood_group'],
     $allergies,
	  $_POST ['blood_pressure'],
     $_POST ['heart_disease'],
	 $M_detailas,
     $_POST ['insurance'],
	  $insurance_company_name,
	   $ins_expire_date,
	    $membership_num,
		$_POST['userId']);
	
		if ($result==0){
			  $response ['error'] = true;
       $response['message']="Medical history is not updated...!  ";
		 
        
		 //$response ['message']= 0;	
		}else if($result==1){
		  $user = $db->getHistroyByBloodgroup($_POST['userId']);
	    $response ['history_id'] = $user['history_id'];
	    $response ['blood_group'] = $user['blood_group'];
        $response ['allergies'] = $user['allergies'];
        $response ['blood_pressure'] = $user['blood_pressure'];
        $response ['heart_disease'] = $user['heart_disease'];
		 $response ['M_detailas'] = $user['M_detailas'];
		 $response ['insurance'] = $user['insurance']; 
		 $response ['insurance_company_name'] = $user['insurance_company_name'];
		  $response ['ins_expire_date'] = $user['ins_expire_date'];
		   $response ['membership_num'] = $user['membership_num'];
		 
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
