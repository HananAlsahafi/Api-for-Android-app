<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    if(isset($_POST['email']) and isset($_POST['password'])){
    $db = new DbOperations();
    if ($db->userLogin($_POST['email'] ,$_POST['password'])){
        $user = $db->getUserByUsername($_POST['email']);
        $response ['error'] = false;
        $response['userId']=$user['userId'];
        $response ['firstName'] = $user['firstName'];
        $response ['lastName'] = $user['lastName'];
        $response ['age'] = $user['age'];
        $response ['email'] = $user['email'];
        $response ['phoneNumber'] = $user['phoneNumber'];
        $response ['password'] = $user['password'];
		 $response ['deviceLicense'] = $user['deviceLicense'];
		
        $response['have']="No";
    if($db->isUserHaveHistory($user['userId'])){
        $userHistory = $db->getHistory($user['userId']);
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
    } 
    }
    else {
        $response ['error'] = true;
        $response ['message']= "Invalid email or password ..!";
    }
    }
    else{
        $response ['error'] = true;
        $response ['message']= "Requierd fields are missing ..!";
    }
}
else {
    $response ['error'] = true;
    $response ['message']= "Invalid Request";
   }
   
   echo json_encode($response);