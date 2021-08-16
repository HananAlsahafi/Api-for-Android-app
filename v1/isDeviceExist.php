<?php
require_once '../includes/DbOperations.php';
$response = array();

if ($_SERVER['REQUEST_METHOD']== 'POST'){

    if(isset($_POST['license']))
    {
    $db = new DbOperations();
    $result = $db->isDeviceExist ($_POST['license']);
     if($result > 0){
		 $response['success']=1;
        $response ['error'] = false;
        $response ['message']= "The SADS ID is correct ..";
		$user = $db->getlicenseByLicense ($_POST['license']);
        $response ['error'] = false;
        $response ['license'] = $user['license'];
     }else if ($result==0){
		 $response['success']=0;
        $response ['error'] = true;
        $response ['message']= " The SADS ID is not correct !";
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
