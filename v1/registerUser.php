<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(
    isset($_POST['firstName']) and
    isset($_POST ['lastName']) and
    isset($_POST ['age'])and
    isset($_POST ['email']) and
    isset($_POST ['phoneNumber']) and
    isset($_POST ['password'])){
   if(isset($_POST['deviceLicense'])){
      $deviceLicense = $_POST['deviceLicense'];
   }else {
      $deviceLicense = "0" ;
   }
   if (isset($_POST['plateNumber'])){
      $plateNumber = $_POST['plateNumber'];
   }else {
      $plateNumber = "0" ;
   }
     $db = new DbOperations();
     $result = $db->createUser(
     $_POST['firstName'],
     $_POST ['lastName'],
     $_POST ['age'],
     $_POST ['email'],
     $_POST ['phoneNumber'],
     $_POST ['password'] ,
    $deviceLicense ,
    $plateNumber);
     if ($result==0){
      $response ['error'] = true;
      $response ['message']= "The user already exist ..!";
   } else if ($result==1){
      $response ['error'] = true;
      $response ['message']= "The phoneNumber is exist ..!";
   }  else if ($result==2){
      $response ['error'] = true;
      $response ['message']= "The device is not exist ..!";
   }
     else if($result == 3){
		    $response ['error'] = true;
      $response ['message']= "The device is not availible ..!";
       

     }
     else if ($result==4){
		  $response ['error'] = false;
        $response ['message']= "User registered successfully ..";
		     $user = $db->getUserByUsername($_POST['email']);
		 $response ['userId'] = $user['userId'];
        $response ['firstName'] = $user['firstName'];
        $response ['lastName'] = $user['lastName'];
        $response ['age'] = $user['age'];
        $response ['email'] = $user['email'];
        $response ['phoneNumber'] = $user['phoneNumber'];
        $response ['password'] = $user['password'];
		$response ['deviceLicense'] = $user['deviceLicense'];
      
     }
	  else if ($result==5){
		
        $response ['error'] = true;
        $response ['message']= "Some error ocurred .. try again !";
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

