<?php
  include dirname(__FILE__) . '../includes/DbConnect.php';?>
  

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Devices</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src ="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
      $(window).on('scroll',function(){
        if($(window).scrollTop()){
          $('nav').addClass('black');
        }
        else{
          $('nav').removeClass('black');
        }


      })

    </script>
</head>
<style type="text/css">
  body {

  width: 100%;
	height:100%;
	background-image: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)), url("img/background-blurred.jpg");
	background-size:cover;
	background-repeat: no-repeat;
	background-position: center;

}

nav {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100px;
	padding: 10px 100px;
	box-sizing: border-box;
	transition: .3s;
	z-index: 3;
}
nav.black{
	background: rgba(0,0,0,0.6);
	height: 100px;
	padding: 10px 100px; 
}
nav .logo{
	padding: 22px 20px;
	height: 80px;
	float: left;
	font-size:16 px;
	transition: .3s; 
	font: normal 40px 'Cookie', cursive;
	/*height: 40px;*/
}
nav.black .logo{
	
	color: #fff;
}
nav ul {
	list-style: none;
	float: right;
	margin: 0;
	padding: 0;
	display: flex;
}
nav ul li {
	list-style: none;
}
nav ul li a {
	line-height: 80px;
	color: #000;
	padding: 12px 30px;
	text-decoration: none;
	text-transform: uppercase;
	transition: .3s;
}
nav.black ul li a {
	color: #fff;
}
nav.black ul li a:hover {
	color: #01DFA5;
}
nav ul li a:focus{
	outline: none;
}
nav ul li a.active{
	background: #E2472F;
	color: #fff;
	border-radius: 6px;
}

a:link {
    text-decoration: none;
    color: white;
}
a:hover {
    text-decoration: none;
    color: white;
}

h1 {
	font-family: sans-serif;
	letter-spacing: 1px;
}
h1:after{
	content: '';
	background:white;
	display: block;
	width: 150px;
	height: 3px;
	margin: 10px auto;
}
.icon{
	font-size: 40px;
	margin: 5px auto;
	padding: 15px;
	height: 90px;
	width: 80px;
	border:1px solid white;
	border-radius:50%;
}
.col-md-3:hover{
	box-shadow: 5px 7px 9px -3px rgba(255,255,255,0.5);
	cursor: pointer;
}
h2{
  text-align: center;
  font-family: Courier;
}
table {
  border-collapse: collapse;
  width: 80%;
  margin: auto;
  border: 1px solid #ddd;
  background-color: #fff;
  color: #000;

}

th{
  height: 35px;
  text-align: left;
  vertical-align: top;
  background-color: crimson;
  color: #fff;
}

th, td {
padding: 10px;
border-bottom: 1px solid #ddd;
}
input[type=text]{
    width: 200px;
    height: 40px;
    border-bottom: 1px solid #fff;
    background: transparent;
    font-size: 18px;
    margin-bottom: 10px;
    margin-right: 10px;
    font-family: Courier;
    color: #fff;

  }
.forms {

    width: 700px;
    border-radius: 6px;
    padding: 16px;
    margin: auto;
    border:1px solid white;
    text-align: center;
    opacity: .90;

  }
  label{
 font-family: Georgia, "Times New Roman", Times, serif;
 font-size: 18px;
 height: 20px;
 width: 80px;
 color: #01DFD7;
  }

tr:hover{
  background-color:#aaa;
}
button{
  font-family: Georgia, "Times New Roman", Times, serif;
  width: 90px;
  border:none;
  outline: none;
  background:crimson;
  color: #fff;
  font-size: 18px;
  border-radius: 20px;
  padding: 10px;
}
button:hover{
  cursor: pointer;
  background:#fff;
  color: #000;
}
  .alert{
    margin-left:10%;
    font-size: 18px;
	font-family: Courier;
	color: #fff;
  }  
  
</style>
<body>

  <div class = "wrapper">
  <nav>
    <div class = "logo"> SADS</div>
    <ul>
      <li><a href="HomePage.html">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a class = "active" href="index.html">Logout</a></li>
    </ul>
  </nav>

</div>
<br><br><br><br>
<br><br><br><br>
<h2> Device information </h2>


<?php
	$db = new DbConnect();
	$con = $db->connect();
	
$sql = "SELECT * FROM `devices`";
$result = mysqli_query($con,$sql);

  $id = "";
  $license = "";
  $status = "";
  $userId = "";

  if(isset($_POST['device_id'])){
    $id = $_POST['device_id'];
  }
  if(isset($_POST['license'])){
    $license = $_POST['license'];
  }
  if(isset($_POST['status'])){
    $status = $_POST['status'];
  }

  if(isset($_POST['user_id'])){
    $userId = $_POST['user_id'];
	if($userId==0){
		$userId="null";
	}else{
		
		 $userId = $_POST['user_id'];
	}
	
  }

  $sqls = "";
  if(isset($_POST['btnAdd'])){
      
    $sql1 = "select * from devices where license = $license";
    $result1 = mysqli_query($con,$sql1);
    $count1 = mysqli_num_rows($result1);
    
    $sql2 = "select * from users where deviceLicense = $license";
    $result2 = mysqli_query($con,$sql2);
    $count2 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_assoc($result2);
    
	if ($count1 > 0){
	echo "<div class ='alert'> The device already exist </div>";
	}
	else if  ($userId != 0 ){
	if ($row2['userId'] == $userId){
    $sqls = "insert into devices values($id,'$license','$status','$userId')";
    mysqli_query($con,$sqls);
    
	}else{
	echo "<div class ='alert'> This user have not this device </div>";
	}
	}
	else if ($userId == "null" ){
    $sqls = "insert into devices values($id,'$license','Available',null, '0','0')";
    mysqli_query($con,$sqls);
	}
  }
  if(isset($_POST['btnEdit'])){
    $sqls = "update devices set license='$license',status='$status',userId=$userId where deviceId=$id";
    mysqli_query($con,$sqls);
  }
  if(isset($_POST['btnDel'])){
    $sql2 = "select * from users where deviceLicense = $license";
    $result2 = mysqli_query($con,$sql2);
    $count2 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_assoc($result2);
    
    if  ($userId != 0 ){
	if ($row2['userId'] == $userId){
    echo "<div class ='alert'> The device is used by user </div>";
	}else{
    $sqls = "delete from devices where deviceId = $id";
    mysqli_query($con,$sqls);
	}
  } else if ($userId == 0){
    $sqls = "delete from devices where deviceId = $id";
    mysqli_query($con,$sqls);
  }
  }

  ?> 

   <form method="post">
   <div class = "forms">
        <div id='textField'></div>
       <label> Device id </label>
       <input type="text" id="device_id" name="device_id" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
       <label> License </label>
       <input type="text" id="license" name="license" required maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> <br>
       <label> Status </label>
       <input type="text" id="status" name="status">
       <label> User id </label>
       <input type="text" id="user_id" name="user_id" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
       <br> <br>
       <div>
           <button name="btnAdd">Add</button> 
           <button name = "btnEdit">Edit</button>
           <button name = "btnDel">Delete</button>
       </div>
  </div>
   <br><br>
   <table id='devices'>
   <tr>
    <th> Device id </th>
   <th> License </th>
   <th> Status </th>
   <th> User id </th>
   </tr>
   <?php
   while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["deviceId"]. "</td>".
    "<td>" . $row["license"]. "</td>".
    "<td>" . $row["status"]. "</td>".
    "<td>" . $row["userId"]. "</td>".
    "</tr>";
}
?>
</table>
<br><br>
</form>

<script>
var tbl = document.getElementById("devices");
for (var i=1 ; i<tbl.rows.length ; i++){
    tbl.rows[i].onclick = function (){
        document.getElementById("device_id").value = this.cells[0].innerHTML;
        document.getElementById("license").value = this.cells[1].innerHTML;
        document.getElementById("status").value = this.cells[2].innerHTML;
        document.getElementById("user_id").value = this.cells[3].innerHTML;
    }
}
</script>

</body>
</html>

