<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ArduinoOperations{
    private $con;
    public $userId;
    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();
    }
public function getUserId ($license){
   
   // echo 'hello2';
    $stmt = $this->con->prepare("SELECT userId FROM users WHERE deviceLicense = ?");
    $stmt->bind_param("s", $license );
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    return $row['userId'];

    }
public function getUserInfo ($license){
   
       // echo 'hello';
        $userId = $this->getUserId($license);
        $stmt = $this->con->prepare("SELECT * FROM users WHERE userId = ?");
        $stmt->bind_param("s", $userId );
        $stmt->execute();
      //  echo "done";

        return $stmt->get_result()->fetch_assoc();

        }
public function sendReport($license,$deviceId,$longtitude , $latitude){
        $row= $this-> getUserInfo($license);
        //$deviceId=$deviceId;
       // echo $deviceId;
        $userId=$row['userId'];
       // echo $userId . "  ";
        $plateNumber=$row['plateNumber'];      

        $mobile=$row['phoneNumber']; 
        $time = "22/2/2019";
        $stmt= $this->con->prepare("INSERT INTO `deviceReports`(`deviceId`, `userId`, `plateNumber`, `phoneNumber`, `longtitude`, `latitude`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $deviceId , $userId ,$plateNumber ,$mobile,$longtitude ,$latitude);
        $stmt->execute();      
}
}


