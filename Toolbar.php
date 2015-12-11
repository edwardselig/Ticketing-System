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
		<title>Toolbar</title>
		<script src = "../../jquery.js"></script>
<style>
#boxs {
	background:#3D8ACB;
	text-align:center;
	color:white;
	width:300px;
	height:55px;
	margin: 0 auto;
	border-color: black;
	font-family: sans-serif;
}
.button {
	margin: 3px 2px 0px 2px;
	background-color: white;
	border-radius: 5px;
}
form{
	display: inline;
}
</style>
<!--<script>
	$(document).ready(function(){
		$("#Home").click(function(){
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/HomePage.php';
			});
		});
		$("#Tickets").click(function(){
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplay.php';
			});
		});
		$("#create").click(function(){
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplayAndReport.php';
			});
		});
		$("#Logout").click(function(){
			window.location.replace = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/LogOut.php';
			window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Input/LogIn.php';
			});
		});
	});
</script>-->
	</head>
<body>
	<div id="boxs">
		<th><?php echo "Logged In As " . $arr['first'] . ' ' . $arr['last']  ?></th>
		<table>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/LogOut.php"><input type ="submit" name = "Logout" value = "Logout" id = "Logout" class = 'button'></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/HomePage.php"><input type ="submit" name = "Home" value = "Home" id = "Home" class = 'button'></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplay.php"><input type ="submit" name = "Tickets" value = "View Tickets" id = "Tickets" class = 'button'></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplayAndReport.php"><input type ="submit" name = "create" value = "Write Ticket" id = "create" class = 'button'></form></th>
		</table>
	</div>
</body>
</html>
