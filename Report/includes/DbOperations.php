<?php

class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();

    }

   public function createReport($type, $userId, $incident_category,$latitude,$longitude,$num_injured ,$comment){
      
       
        $stmt= $this->con->prepare("INSERT INTO `reports` (`report_id`, `type`, `userId`, `incident_category`, `latitude`,`longitude`,`num_injured`,`comment`) 
		VALUES (NULL, ?, (SELECT userId FROM users where userId=?), ?, ?,?,?,?);");
        $stmt->bind_param("sssssss", $type, $userId, $incident_category,$latitude,$longitude,$num_injured ,$comment);
        
       if($stmt->execute()){
           return true;
       }else {
           return false;
       }
    }
}
   


