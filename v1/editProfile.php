<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    if(
    isset($_POST['firstName']) and
    isset($_POST ['lastName']) and
    isset($_POST ['age'])and
    isset($_POST ['email']) and
    isset($_POST ['phoneNumber'])){
    
     $db = new DbOperations();
     $result = $db->editProfile(
     $_POST['userId'],
     $_POST['firstName'],
     $_POST ['lastName'],
     $_POST ['age'],
     $_POST ['email'],
     $_POST ['phoneNumber']);
    if($result == 0){
        $user = $db->getUserByUsername($_POST['email']);
        $response ['error'] = false;
        $response['userId']=$user['userId'];
        $response ['firstName'] = $user['firstName'];
        $response ['lastName'] = $user['lastName'];
        $response ['age'] = $user['age'];
        $response ['email'] = $user['email'];
        $response ['phoneNumber'] = $user['phoneNumber'];
        $response ['password'] = $user['password'];

        $response ['error'] = false;
        $response ['message']= "Updated successfully ..";
     }
     else if ($result==1){
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