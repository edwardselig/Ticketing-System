<?php
	session_start();
	$servername = "localhost";
	$username = "quantco_Ted";
	$password = "Quantum1";
	$database = "quantco_Interns";

	$con = mysqli_connect($servername,$username,$password,$database);
	
	if($con->connect_error){
		die("Connection failed " . $con->connect_error);
	}
	if(isset($_POST['loginemail'])&&isset($_POST['loginpass'])){
		$email = $_POST['loginemail'];
		$pass = md5($_POST['loginpass']);
		$sql = "select pass from Employee where email='$email'";
		$query = mysqli_query($con,$sql);
		$array = mysqli_fetch_array($query);
		$dbpass = $array['pass'];
		if($pass==$dbpass){
			echo "<script> window.location.href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/HomePage.php'</script>";
			$_SESSION["email"] = $email;
		}else {
		session_destroy();
		echo "incorrect password or email";}
	}
	if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['department'])&&isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['pass2'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$id = $_POST['department'];
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		$pass2 = md5($_POST['pass2']);
		if(!($pass==$pass2)){
			echo "<h2>Your passwords do not match, please try again!</h2>";
			exit();
		}
		$sel = "select * from Employee where email='$email'";
		$run = mysqli_query($con,$sel);
		$check_email = mysqli_num_rows($run);
			if($check_email==1){
				echo "<h2>This email is already registered, please try another!</h2>";
				exit();
			}
		$insert = "insert into Employee (email, first, last, department_id,pass) values ('$email','$firstname','$lastname','$id', '$pass')";
		$run_insert = mysqli_query($con,$insert);
		if($run_insert){
			echo "<h2>Registration Successful, Thanks!</h2>";
		}
	}
	mysqli_close($con);

?>
