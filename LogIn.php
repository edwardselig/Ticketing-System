<!DOCTYPE html>
<html>
	<head>
		<title>Ticket Log In</title>
		<script src = "../../jquery.js"></script>
<style>
body{
	padding:0;
	margin:0;
	background:#3D8ACB;
}
#box {
	background:white;
	text-align:center;
	padding:10px;
	color:white;
	width:500px;
	height:300px;
	margin: 0 auto;
	border: 1px solid #0000E6;
	
}
#LogIn {
	background:white;
	text-align:center;
	padding:10px;
	color:white;
	width:500px;
	height:300px;
	margin: 0 auto;
	border: 1px solid #0000E6;
}
</style>
<script>
	$(document).ready(function(){
		$("#sub").click(function(){
			var first_name = $("#firstname").val();
			var last_name = $("#lastname").val();
			var user_email = $("#email").val();
			var department_id = $("#department").val();
			var user_pass = $("#pass").val();
			var user_pass2 = $("#pass2").val();
			$.post("../Resources/LogInHelper.php",{firstname:first_name,lastname:last_name,email:user_email,department:department_id,pass:user_pass,pass2:user_pass2},function(data){
				$("#result").html(data);
			});
			document.getElementById('firstname').value='';
			document.getElementById('lastname').value='';
			document.getElementById('email').value='';
			document.getElementById('pass').value='';
			document.getElementById('pass2').value='';
			$('#department').prop('selectedIndex', 0);
		});
		$("#sub2").click(function(){
			var loginuser_email = $("#loginemail").val();
			var loginuser_pass = $("#loginpass").val();
			$.post("../Resources/LogInHelper.php",{loginemail:loginuser_email,loginpass:loginuser_pass},function(data){
				$("#result2").html(data);
			});
		});
		$('#box').hide();
		$('.new').click(function() {
   			$('#box').toggle();
   			$('#LogIn').toggle();
});
	});
	/*
		do i need to add attachment option to the ticket?
		i should add link to each table and allow users to message the author
		should users be able to see tickets they have sent out
	*/
</script>
	</head>
<body>
	<div id="box">
		<input type ="submit" class = "new" value = "Registered User Login">
		<h2 style = 'color: #0000E6; font-family: sans-serif;'>New User Register Here:</h2>
		<input type ="text" name="firstname" id="firstname" placeholder="Enter Your First Name"/></br>
		<input type ="text" name="lastname" id="lastname" placeholder="Enter Your Last Name"/></br>
		<input type ="text" name="email" id="email" placeholder="Enter Your Email"/></br>
		<form action="LogInHelper.php" method="post">
		<select id = "department" name = "department">
		<?php 
					$servername = "localhost";
					$username = "quantco_Ted";
					$password = "Quantum1";
					$database = "quantco_Interns";

					$con = mysqli_connect($servername,$username,$password,$database);
						if($con->connect_error){
						die("Connection failed " . $con->connect_error);
					} 
					$sql = "select Department_name,id from Department";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$department = $row['Department_name'];
    					$id = $row['id'];
    					echo "<option value = '$id'>$department</option>";
					}
		?></select></form>
		<input type ="password" name="pass" id="pass" placeholder="Enter Your Password"/></br>
		<input type ="password" name="pass2" id="pass2" placeholder="Re-Enter Your Password"/>
		</br></br>
		<input type ="submit" name = "sub" value = "Register" id = "sub"/>
		<div id="result"></div>
	</div>
	<div id="LogIn">
		<input type ="submit" class = "new" value = "New User Register">
		<h2 style = 'color: #0000E6; font-family: sans-serif;'>Registered User Log In:</h2>
		<input type ="text" name="loginemail" id="loginemail" placeholder="Enter Your Email"/></br>
		<input type ="password" name="loginpass" id="loginpass" placeholder="Enter Your Password"/>
		</br></br>
		
		
		<input type ="submit" name = "sub2" value = "Submit" id = "sub2"/>
		<div style = 'color:black;' id="result2"></div>
	</div>
</body>
</html>
