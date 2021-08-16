<?php

class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();

    }

   public function createHistory($blood_group , $allergies ,$blood_pressure , $heart_disease,$M_detailas,$insurance,
   $insurance_company_name,$ins_expire_date,$membership_num,$userId){
      if($this->isAlreadyHavingHistory($userId)){
		  $this->getHistroyByBloodgroup($userId);
		  return 0;
	  }
	  else{
       
        $stmt= $this->con->prepare("INSERT INTO `medicalhistory` (`history_id`, `blood_group`, `allergies`, 
		`blood_pressure`, `heart_disease`,`M_detailas`,`insurance`,`insurance_company_name`,`ins_expire_date`,`membership_num`,`userId`) 
		VALUES (NULL, ?, ?, ?, ?,?,?,?,?,?,(SELECT userId FROM users where userId=?));");
	
        $stmt->bind_param("ssssssssss", $blood_group , $allergies ,$blood_pressure ,$heart_disease ,$M_detailas,$insurance, $insurance_company_name, $ins_expire_date , $membership_num,$userId);
		
		
       if($stmt->execute()){
           return 1;
       }else {
           return 2;
		  
	  }}
    }
	public function getHistroyByBloodgroup($userId){
		$stmt=$this->con->prepare("SELECT * FROM medicalhistory WHERE userId=?");
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();
		
		
	}
	
public function isAlreadyHavingHistory ($userId){
	   $stmt = $this->con->prepare("SELECT userId FROM medicalhistory WHERE userId = ?");
        $stmt->bind_param("s", $userId );
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0 ;
}
public function updateHistory ($blood_group , $allergies ,$blood_pressure , $heart_disease,$M_detailas,$insurance,
   $insurance_company_name,$ins_expire_date,$membership_num,$userId){
	   $stmt = $this->con->prepare("UPDATE `medicalhistory` SET `blood_group`=?,`allergies`=?,
	   `blood_pressure`=?,`heart_disease`=?,`M_detailas`=?,`insurance`=?,`insurance_company_name`=?,`ins_expire_date`=?,`membership_num`=? WHERE userId = ?");
        $stmt->bind_param("ssssssssss", $blood_group , $allergies ,$blood_pressure ,$heart_disease ,$M_detailas,$insurance, $insurance_company_name, $ins_expire_date , $membership_num,$userId);
       	   $stmt->execute();
		  //updated row count
return $stmt->affected_rows;

       
}
	
	
}

   


