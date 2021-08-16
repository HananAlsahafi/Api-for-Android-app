<?php

class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();

    }

   public function createSOS($type , $latitude,$longitude,$userId ){
      
       
        $stmt= $this->con->prepare("INSERT INTO `sos` (`sos_id`, `type`, `latitude`, `longitude`,`user_Id`) VALUES (NULL, ?, ?, ?,(SELECT userId FROM users where userId=?));");
        $stmt->bind_param("ssss", $type , $latitude ,$longitude , $userId);
        
       if($stmt->execute()){
           return true;
       }else {
           return false;
       }
    }
}
   


