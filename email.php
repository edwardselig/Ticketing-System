<?php
	$servername = "localhost";
	$username = "quantco_Ted";
	$password = "Quantum1";
	$database = "quantco_Interns";

	$con = mysqli_connect($servername,$username,$password,$database);
	if($con->connect_error){
		die("Connection failed " . $con->connect_error);
	}		
	$sel1 = "select id, request, priority, issue_id, author, date from Ticket_Main Where complete=0 and date < DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 15 HOUR)";
	$run2 = mysqli_query($con,$sel1);
		while ($res1 = mysqli_fetch_array($run2)){
			$MainId = $res1['id'];
			$priority = $res1['priority'];
			$issue = $res1['request'];
			$author = $res1['author'];
			$issue_id = $res1['issue_id'];
			$date = $res1['date'];
			
			$sel = "select issue_name, department_id from Issue where id='$issue_id'";
			$run = mysqli_query($con,$sel);
			if (!$run) {
    			die('Invalid query: ' . mysqli_error($con));
			}
			$res = mysqli_fetch_array($run);
			$type1 = $res['issue_name'];
			$DepId = $res['department_id'];
			
			$sel3 = "select department_name from Department where id='$DepId'";
			$run4 = mysqli_query($con,$sel3);
			$res3 = mysqli_fetch_array($run4, MYSQLI_NUM);
			$Dep = $res3[0];
			
			$sel4 = "select email from Employee Where department_id = '$DepId'";
			$run5 = mysqli_query($con,$sel4);
			
			$last = explode(' ', $author);
			$lastn = $last[1];
			$sel5 = "select email from Employee Where last = '$lastn'";
			$run6 = mysqli_query($con,$sel5);
			$res5 = mysqli_fetch_array($run6, MYSQLI_NUM);
			$sender = $res5[0];
			
			while($res4 = mysqli_fetch_array($run5)){
				$to = $res4['email'];
				$subject = 'UNRESOLVED TICKET: '.$priority .' ' . $type1 . ' Ticket #' . $MainId;
				$message =		
"
The following ticket was submitted on $date and has not yet been resolved:

Priority: $priority
Type of issue: $type1
Issue description: $issue

Please click the following link to mark the ticket as resolved:
http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugReport.php?id=".$MainId;
				$from = "From: " . $author . "  <'$sender'>";
				$mail = mail($to,$subject,$message,$from);
			}
		}
	
	//0 8 * * 1-5 /usr/bin/wget http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/email.php
	/*
	add override email selection
	How should we select where the email goes to
	
	*/
?>
