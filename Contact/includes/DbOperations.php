<?php


class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();
    }
	
	public function createContact($userId,$phoneNumber1 , $phoneNumber2){
     if ($this->isAlreadyHavingContact($userId)){
		 return 0;
	 }else{
       
        $stmt= $this->con->prepare("INSERT INTO `userrelative` (`userId`, `phoneNumber1`, `phoneNumber2`) 
		VALUES (?,?,?);");
	
        $stmt->bind_param("sss",$userId,$phoneNumber1 , $phoneNumber2 );
		
		
       if($stmt->execute()){
           return 1;
       }else {
           return 2;
		  
	 }}
    }
	public function getContact($userId){
		$stmt=$this->con->prepare("SELECT * FROM userrelative WHERE userId=?");
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();
		
		
	}
	
public function isAlreadyHavingContact($userId){
	   $stmt = $this->con->prepare("SELECT userId FROM userrelative WHERE userId = ?");
        $stmt->bind_param("s", $userId );
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0 ;
}
	public function updateContact ($userId,$phoneNumber1 , $phoneNumber2 ){
	 	   $stmt = $this->con->prepare("UPDATE `userrelative` SET `phoneNumber1`=?,`phoneNumber2`=? WHERE `userId`=?");
		   
        $stmt->bind_param("sss", $phoneNumber1 , $phoneNumber2 ,$userId);
       	   $stmt->execute();
		  //updated row count
return $stmt->affected_rows;

       

       
}}
	