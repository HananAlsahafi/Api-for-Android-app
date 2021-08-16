<?php

class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();

    }

   public function createTracking($lat , $lng, $license){
     

       
        $stmt= $this->con->prepare("INSERT INTO `trackingcar` (`id`, `lat`, `lng`, `license`) 
		VALUES (NULL ,?,?,?);");
	
        $stmt->bind_param("sss", $lat , $lng,$license);
		
       if($stmt->execute()){
           return 1;
       }else {
           return 2;
		  
	  }
    }
	public function getlocation($license){
		$stmt=$this->con->prepare("SELECT * FROM trackingcar WHERE license=?");
		$stmt->bind_param("s", $license);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();
		
		
	}
	
public function updateHistory ($lat,$lng,$license){
	   $stmt = $this->con->prepare("UPDATE `trackingcar` SET `lat`=?,`lng`=?, WHERE ;license = ?");
        $stmt->bind_param("sss", $lat , $lng ,$license);
       	   $stmt->execute();
		  //updated row count
return $stmt->affected_rows;

       
}
	
	
}

   


