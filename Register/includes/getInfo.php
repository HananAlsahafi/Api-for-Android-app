<?php
     echo 'Hi';

    $dbusername = "root";  
    $dbpassword = "";  
    $server = "localhost"; 
  echo "Hi";
  if (!@mysql_connect($server , $mysql_user)){
    die("Cannot connect to database ..!");
}
    $dbselect = mysqli_select_db($dbconnect, "SADS system");
    echo "Hi2";

    $plate_number= $_GET['plate_number'];
    $mobile= $_GET['mobile'];
    echo "H3";

    $sql = "INSERT INTO `deviceReports`(`plateNumber`, `phoneNumber`) VALUES (?,?)";    
    $stmt->bind_param("ss", $plateNumber , $mobile);

    mysqli_query($dbconnect, $sql);

?>