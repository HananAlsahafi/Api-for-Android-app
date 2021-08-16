<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['userId'])){

   
		
     $db = new DbOperations();
	
			  $response ['error'] = false;
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
