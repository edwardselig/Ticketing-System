<?php
	session_start();
	$email = $_SESSION['email'];
	if($email ==null){die(header( 'Location: http://quantum-co.com/Internship_Program/Edward/Project_5/Input/LogIn.php' ));}

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
	
	if (isset($_GET['being'])){
			$date1 = date("Y-m-d H:i:s");
			$being = $_GET['being'];
    		$sql1 = "UPDATE Ticket_Main SET complete = '2' WHERE id='$being'";
    		if ($con->query($sql1) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
			$sql1 = "UPDATE Ticket_Main SET updated = '$date1' WHERE id='$being'";
    		if ($con->query($sql1) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
    	}
	
	$i = 0;
	echo "<script src = '../../jquery.js'></script>";
	echo "<style>
	body{background-color:#3D8ACB;
	font-family: sans-serif;
	}
	.tab{
		border: 1px solid #0000E6;
		border-collapse: collapse;
		padding:3px;
	}
	a{
	text-decoration:none;
	color:inherit;}
	.col{
		color: #0000E6;
		background-color: #58C6EB;
		border: 1px solid #0000E6;
		border-collapse: collapse;
		padding:3px;
	}
	td { word-wrap: break-word; }
	#boxs {
	background:#3D8ACB;
	text-align:center;
	color:white;
	width:300px;
	height:55px;
	margin: 0 auto;
	border-color: black;
}
.button {
	margin: 3px 2px 0px 2px;
	background-color: white;
	border-radius: 5px;
}
	</style>";
	echo "<script>
		$(document).ready(function(){
			$('#outbox').hide();
			$('#toggle').click(function() {
   				$('#inbox').toggle();
   				$('#outbox').toggle();
   				if(document.getElementById('toggle').value=='Outbox'){
   					document.getElementById('toggle').value='Inbox';
   				}else{document.getElementById('toggle').value='Outbox';}
			});
		});
	</script>";
	$first = $arr['first'];
	$last = $arr['last'];
	//echo '<div style = "background-color: #3D8ACB;">';
	echo '<div id="boxs">
		<th>Logged In As ' . $first . ' ' . $last . '</th>
		<table>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/LogOut.php"><input type ="submit" name = "Logout" value = "Logout" id = "Logout" class = "button"></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/HomePage.php"><input type ="submit" name = "Home" value = "Home" id = "Home" class = "button"></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplay.php"><input type ="submit" name = "Tickets" value = "View Tickets" id = "Tickets" class = "button"></form></th>
		<th><form action="http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/BugDisplayAndReport.php"><input type ="submit" name = "create" value = "Write Ticket" id = "create" class = "button"></form></th>
		</table>
	</div>';
	
	echo "<table style = 'margin: 0 auto;'><th><input type = 'submit' class = 'button' value = 'Outbox' id = 'toggle' name = 'toggle'/></th></table>";
	echo "<div id = 'inbox'>";
	echo "<table style = 'margin: 0 auto; border: 1px; border-style:solid; border-collapse: collapse;'><tr>
	<th class = col>Priority</th>
	<th class = col>Issue Category</th>
	<th class = col style = 'width: 262px'>Subject</th>
	<th class = col>Author</th>
	<th class = col>date</th>
	<th class = col>Last Update</th>
	<th class = col>Resolved Date</th></tr>";
	//while($arr2 = mysqli_fetch_array($run2)){
		isset($_SESSION['email']) ? $strSQL = "SELECT * FROM Ticket_Main where priority = 'Urgent' AND receiver = '$email'" : $strSQL = "SELECT * FROM Ticket_Main where priority = 'Urgent'";
		isset($_SESSION['email']) ? $strSQL2 = "SELECT * FROM Ticket_Main where priority = 'High' AND receiver = '$email'" : $strSQL2 = "SELECT * FROM Ticket_Main where priority = 'High'";
		isset($_SESSION['email']) ? $strSQL3 = "SELECT * FROM Ticket_Main where priority = 'Regular' AND receiver = '$email'" : $strSQL3 = "SELECT * FROM Ticket_Main where priority = 'Regular'";
		isset($_SESSION['email']) ? $strSQL4 = "SELECT * FROM Ticket_Main where priority = 'Low' AND receiver = '$email'" : $strSQL4 = "SELECT * FROM Ticket_Main where priority = 'Low'";
		$rs = mysqli_query($con,$strSQL);
		$rs2 = mysqli_query($con,$strSQL2);
		$rs3 = mysqli_query($con,$strSQL3);
		$rs4 = mysqli_query($con,$strSQL4);
		while($row = mysqli_fetch_array($rs)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete, iscomplete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2);
		$run3 = $res1['date_complete'];
		$s = $res1['iscomplete'];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs2)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs3)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' >"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs4)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	echo "</table>";
	echo "</div>";
	echo "<div id = 'outbox'>";
	echo "<table style = 'margin: 0 auto; border: 1px; border-style:solid; border-collapse: collapse;'><tr>
	<th class = col>Priority</th>
	<th class = col>Issue Category</th>
	<th class = col style = 'width: 262px'>Subject</th>
	<th class = col>Author</th>
	<th class = col>date</th>
	<th class = col>Last Update</th>
	<th class = col>Resolved Date</th></tr>";
	//while($arr2 = mysqli_fetch_array($run2)){
		isset($_SESSION['email']) ? $strSQL = "SELECT * FROM Ticket_Main where priority = 'Urgent' AND email = '$email'" : $strSQL = "SELECT * FROM Ticket_Main where priority = 'Urgent'";
		isset($_SESSION['email']) ? $strSQL2 = "SELECT * FROM Ticket_Main where priority = 'High' AND email = '$email'" : $strSQL2 = "SELECT * FROM Ticket_Main where priority = 'High'";
		isset($_SESSION['email']) ? $strSQL3 = "SELECT * FROM Ticket_Main where priority = 'Regular' AND email = '$email'" : $strSQL3 = "SELECT * FROM Ticket_Main where priority = 'Regular'";
		isset($_SESSION['email']) ? $strSQL4 = "SELECT * FROM Ticket_Main where priority = 'Low' AND email = '$email'" : $strSQL4 = "SELECT * FROM Ticket_Main where priority = 'Low'";
		$rs = mysqli_query($con,$strSQL);
		$rs2 = mysqli_query($con,$strSQL2);
		$rs3 = mysqli_query($con,$strSQL3);
		$rs4 = mysqli_query($con,$strSQL4);
		while($row = mysqli_fetch_array($rs)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete, iscomplete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2);
		$run3 = $res1['date_complete'];
		$s = $res1['iscomplete'];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs2)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs3)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' >"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'>"."<a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	while($row = mysqli_fetch_array($rs4)){
		if(($i % 2) == 0){
			echo '<tr style="border: 1px; background:#FFFFFF; color: black">';
		}else {echo '<tr style="border: 1px; background:#F3F9FF; color: black">';}
		$id = $row['issue_id'];
		$sel = "select issue_name from Issue where id = '$id'";
		$run1 = mysqli_query($con,$sel);
		$res = mysqli_fetch_array($run1, MYSQLI_NUM);
		$run = $res[0];
		
		$MainId = $row['id'];
		$sel1 = "select date_complete from TransAct where Ticket_Main_id= '$MainId'";
		$run2 = mysqli_query($con,$sel1);
		$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
		$run3 = $res1[0];
		
		$sql = "select complete from Ticket_Main where id = '$MainId'";
		$query = mysqli_query($con, $sql);
		$ar = mysqli_fetch_array($query);
		
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['priority'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $run . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' style = 'word-break:keep-all;width: 262px;'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['subject'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['author'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab' ><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['updated'] . "</a></td>";
		echo "<td style= 'color: ".findcolor($ar)."' class = 'tab'><a href = 'http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=$MainId'>" . $row['date_comp'] . "</a></td>";
		echo '</tr>';
		$i = $i + 1;
	}
	echo "</table>";
	echo "</div>";
	function findcolor($ar){
		if($ar['complete']=='0'){
			return "red";
		}
		if($ar['complete']=='1'){
			return "green";
		}
		if($ar['complete']=='2'){
			return "orange";
		}
	}
?>
