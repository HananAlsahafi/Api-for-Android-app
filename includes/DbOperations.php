<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class DbOperations{
    private $con;

    function __construct(){
        require_once dirname(__FILE__) . "/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();

    }

   public function createUser($firstName , $lastName, $age ,$email , $phone , $pass , $device_license=0 , $plateNumber=0){
      
   

	   if ($this->isUserExist($email)){
            return 0 ;
        }
		   	//isPhoneNumberExist
		    $stmt = $this->con->prepare("SELECT userId FROM users WHERE phoneNumber = ? ");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
           
 
		if ($stmt->num_rows > 0){
			
			return 5;
		} 
		 $stmt = $this->con->prepare("SELECT userId FROM users WHERE plateNumber = ? ");
        $stmt->bind_param("s", $plateNumber);
        $stmt->execute();
        $stmt->store_result();		
		
		if ($stmt->num_rows > 0){
			
			return 6;
		} 
        if ($this->isDeviceExist($device_license) ) 
        {
            if ($device_license == 0){}
            else{
            return 2;
            }
        }
       if ($this->isDeviceAvailable($device_license) ) {
            return 1;
        }
        
        else{
        $password = md5($pass);
        $stmt= $this->con->prepare("INSERT INTO `users`(`firstName`, `lastName`,`age`,`email`,`phoneNumber`, `password`,`deviceLicense`,`plateNumber`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $firstName , $lastName ,$age ,$email,$phone ,$password,$device_license,$plateNumber);
        
       if($stmt->execute()){
           return 3;
       }else {
           return 4;
       }
    }
}
public function editProfile($userId , $firstName , $lastName, $age ,$email , $phone ){
    $stmt= $this->con->prepare("UPDATE `users` SET `firstName` = '".$firstName."' ,`lastName` = '".$lastName."' ,`age` = '".$age."' ,`email` = '".$email."' ,`phoneNumber` = '".$phone."' WHERE `userId`= '".$userId."' ");
   // $stmt->bind_param("s", $userId );
   if($stmt->execute()){
       return 0;
   }else {
       return 1;
   }
}
public function changeDeviceStatus($license,$userId){
  //  echo "Ello";
    $stmt= $this->con->prepare("UPDATE `devices` SET `status`='Unavailable',`userId`='".$userId."' WHERE license = '".$license."'");
    $stmt->execute();
}
public function addDevice($license , $status ){
    if($this->isDeviceExist){
    $stmt= $this->con->prepare("INSERT INTO `devices`(`license`, `status`) VALUES (?,?)");
    $stmt->bind_param("ss", $license , $status );
   if($stmt->execute()){
       return 1;
   }else {
       return 2;
   }
   } else {
       return 3;
   }
}

   public function userLogin ($email , $pass){
   $password = md5($pass);
   //echo $pass . "<br>" . $password . "<br>";
   $stmt = $this->con->prepare("SELECT userId FROM users WHERE email = ? and password = ? ");
   $stmt->bind_param("ss", $email , $password);
   $stmt->execute();
   $stmt->store_result();
   return $stmt->num_rows > 0;
   //echo $count;
   }
   public function getUserByUsername ($email){
    $stmt = $this->con->prepare("SELECT * FROM users WHERE email = ? ");
    $stmt->bind_param("s", $email );
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
   }
   private function isUserExist($email){
        $stmt = $this->con->prepare("SELECT userId FROM users WHERE email = ? ");
        $stmt->bind_param("s", $email );
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0 ;
    }
    private function isDeviceAvailable($device_license){
        $stmt = $this->con->prepare("SELECT status FROM devices WHERE license = ?");
        $stmt->bind_param("s",$device_license);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        //echo $row['status'];
       if ($row['status']== "Unavailable"){
        //echo $row['status'];
           return 1;
       }
         
    }
   private function isDeviceExist ($device_license){
    $stmt = $this->con->prepare("SELECT deviceId FROM devices WHERE license = ?");
    $stmt->bind_param("s" ,$device_license);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows ==0 ;
   }
   public function createReport($type, $userId, $incident_category,$latitude,$longitude,$num_injured ,$comment){
      
    $stmt= $this->con->prepare("INSERT INTO `userReports` (`reportId`, `type`, `userId`, `incidentCategory`, `latitude`,`longitude`,`injuredNum`,`comment`) 
    VALUES (NULL,?,?,?,?,?,?,?);");
    $stmt->bind_param("sssssss", $type, $userId, $incident_category,$latitude,$longitude,$num_injured ,$comment);
    
   if($stmt->execute()){
       return true;
   }else {
       return false;
   }
}
public function createHistory($userId,$blood_group , $allergies ,$blood_pressure , $heart_disease,$M_detailas,$insurance,
$insurance_company_name,$ins_expire_date,$membership_num){
     $stmt= $this->con->prepare("INSERT INTO `userHistory` (`userId`, `bloodGroup`, `allergies`, 
     `bloodPressure`, `heartDisease`,`mDetails`,`insurance`,`companyName`,`expiryDate`,`membershipNumber`) 
     VALUES (?,?,?,?,?,?,?,?,?,?);");
     $stmt->bind_param("ssssssssss",$userId,$blood_group ,$allergies ,$blood_pressure ,$heart_disease ,$M_detailas,$insurance, $insurance_company_name, $ins_expire_date , $membership_num);
    if($stmt->execute()){
        return 1;
    } else {
        return 2;
   }
}
public function getHistory($userId){
    $stmt=$this->con->prepare("SELECT * FROM userHistory WHERE userId=?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();	
}
public function isUserHaveHistory($userId){
    $stmt = $this->con->prepare("SELECT userId FROM userHistory WHERE userId = ? ");
    $stmt->bind_param("s", $userId );
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0 )
    return true;
    else 
    return false;
}
public function updateHistory ($userId,$blood_group , $allergies ,$blood_pressure , $heart_disease,$M_detailas,$insurance,
   $insurance_company_name,$ins_expire_date,$membership_num){
   /* $stmt= $this->con->prepare("UPDATE `userHistory` SET `bloodGroup` = '".$blood_group."' 
    ,`allergies` = '".$allergies."' ,`bloodPressure` = '".$blood_pressure."' 
    ,`heartDisease` = '".$heart_disease."' ,`mDetails` = '".$M_detailas."'
    ,`insurance` = '".$insurance."' ,`companyName` = '".$insurance_company_name."'
    `expiryDate` = '".$ins_expire_date."' ,`membershipNumber` = '".$membership_num."'
     WHERE `userId`= '".$userId."' ");*/
     $stmt= $this->con->prepare("UPDATE `userHistory` SET `bloodGroup`='".$blood_group."',`allergies`='".$allergies."',`bloodPressure`='".$blood_pressure."',`heartDisease`= '".$heart_disease."',`mDetails`='".$M_detailas."',`insurance`='".$insurance."' ,`companyName`='".$insurance_company_name."',`expiryDate`='".$ins_expire_date."',`membershipNumber`='".$membership_num."' WHERE `userId`='".$userId."' ");
             // $stmt->execute();
             if($stmt->execute()){
                return 1;
            } else {
                return 2;
           }
		  //updated row count
    //return $stmt->affected_rows;       
}

public function getlocation($license){
	if($this->isDeviceExist($license)){
		 
	return 1;
	}
	else{
		
		 	$stmt=$this->con->prepare("SELECT * FROM devices WHERE license=?");
		$stmt->bind_param("s", $license);
		$stmt->execute();
	return $stmt->get_result()->fetch_assoc();
		
		
	}
		
		
	}


}



