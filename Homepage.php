<?php 
	session_start();
	$email = $_SESSION['email'];
					$servername = "localhost";
					$username = "quantco_Ted";
					$password = "Quantum1";
					$database = "quantco_Interns";

					$con = mysqli_connect($servername,$username,$password,$database);
						if($con->connect_error){
						die("Connection failed " . $con->connect_error);
					}
	$sql = "select first, last from Employee where email = '$email'";
	$query = mysqli_query($con,$sql);
	$arr = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ticket Home</title>
		<script src = "../../jquery.js"></script>
<style>
	
body{
	padding:0;
	margin:0;
	background-color:#3D8ACB;
	font-family: sans-serif;
}
#box {
	background:#FFFFFF;
	border: 1px solid #0000E6;
	text-align:center;
	padding:10px;
	color:white;
	width:500px;
	height:300px;
	margin: 0 auto;
}
h2{color: #0000E6;}
input{background-color: white;
		border-radius: 5px;}
</style>
<script>
	$(document).ready(function(){
	$.post("Toolbar.php",{},function(data){
						$("#tool").html(data);
					});
		$("#display").click(function(){
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplay.php';
		});
		$("#send").click(function(){
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplayAndReport.php';
		});
	});
</script>
	</head>
<body>
	<div id = tool></div>
	<div id="box">
		<h2><?php echo "Welcome " . $arr['first'] . ' ' . $arr['last']  ?></h2>
		<input type ="submit" name = "display" value = "Ticket Display" id = "display"></br></br>
		<input type ="submit" name = "send" value = "Send Ticket" id = "send">
		<div id="result"></div>
	</div>
</body>
</html>
