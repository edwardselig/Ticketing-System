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
	
	$author = $arr['first'] . ' ' . $arr['last'];
	
	
	
	
	/*//This is the directory where images will be saved
$target = "http://quantum-co.com/Internship_Program/Edward/Project_5/Project_5/Output";
$target = $target . basename( $_FILES['photo']['name']);

$pic=($_FILES['photo']['name']);

//Writes the photo to the server
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
{
//Tells you if its all ok
echo "The file ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory";
}
else {
//Gives and error if its not
echo "Sorry, there was a problem uploading your file.";
}*/
	$message = $_POST['message'];
	$date = date("Y-m-d H:i:s");
	$MainId = $_POST['MainId'];
	$complete = $_POST['complete'];
	$file = $_POST['photos'];
	
    		$sql1 = "UPDATE Ticket_Main SET complete = '$complete' WHERE id='$MainId'";
    		if ($con->query($sql1) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
			$sql1 = "UPDATE Ticket_Main SET updated = '$date' WHERE id='$MainId'";
    		if ($con->query($sql1) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
			if($complete == '1'){
				$sql1 = "UPDATE Ticket_Main SET date_comp = '$date' WHERE id='$MainId'";
    			if ($con->query($sql1) === TRUE) {
					} else {echo "Error updating record: " . $con->error;}
			}
		$target = "../Output/";
		$target = $target . basename( $_FILES['photos']['name']);
		if(move_uploaded_file($_FILES['photos']['tmp_name'],$target)){
		}else{}
		if($message != null){
			
			$d = date("Y-m-d H:i:s");
			$insert1 = "insert into Ticket_Message (Ticket_Main_id,date,auth,message,attachment) values ('$MainId','$d','$author','$message','$file')";
			$run_insert1 = mysqli_query($con,$insert1);
			if($run_insert1){}
			else{echo "error: " . $con->error;}
			
			$sql = "select * from Ticket_Main where id = '$MainId'";
			$query = mysqli_query($con, $sql);
			$arr = mysqli_fetch_array($query);
			$receiver = $arr['receiver'];
			$send = $arr['email'];
			$priority = $arr['priority'];
			$issue = $arr['request'];
			
			//if receiver == email send to post creator, otherwise send to receiver*/
			$to;
			if($receiver != $email){
				$to = $receiver;}
			if($receiver == $email){
				$to = $send;}
				$subject1 = 'Ticket #' . $MainId . ' has been updated'; //what is a good subject format?
				$message =		
"
Priority: $priority
Issue description: $issue
message: $message

Please click the following link to mark the ticket as being resolved:
http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=".$MainId;
				$from = "From: " . $author. "  <'$email'>";
				mail($to,$subject1,$message,$from);
		}
	mysqli_close($con);
?>
