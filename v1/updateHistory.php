<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['blood_group']) and
    isset($_POST ['blood_pressure']) and
    isset($_POST ['heart_disease'])and
	 isset($_POST ['userId'])
	 )
    {
      if(isset($_POST['insurance'])){
         $insurance = isset($_POST['insurance']);
         }else{
           $insurance = "false"; 
         }
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
      $_POST['userId'],
      $_POST['blood_group'],
      $allergies,
      $_POST ['blood_pressure'],
      $_POST ['heart_disease'],
     $M_detailas,
      $_POST ['insurance'],
      $insurance_company_name,
       $ins_expire_date,
        $membership_num
       );
      if($result==1){
         $userHistory = $db->getHistory($_POST['userId']);
         $response ['bloodGroup'] = $userHistory['bloodGroup'];
         $response ['allergies'] = $userHistory['allergies'];
         $response ['bloodPressure'] = $userHistory['bloodPressure'];
         $response ['heartDisease'] = $userHistory['heartDisease'];
       $response ['mDetails'] = $userHistory['mDetails'];
       $response ['insurance'] = $userHistory['insurance']; 
       $response ['companyName'] = $userHistory['companyName'];
       $response ['expireDate'] = $userHistory['expiryDate'];
       $response ['membershipNumber'] = $userHistory['membershipNumber'];
       $response['have']="Yes";
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
