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
$email = $_SESSION['email'];
if($email ==null){die(header( 'Location: http://quantum-co.com/Internship_Program/Edward/Project_5/Input/LogIn.php' ));}
$MainId = $_POST['MainId'];
		echo "<style>
			.word{
				font-family: sans-serif;
			}
			.info{
				font-size: 12px;
			}
			p { word-wrap: break-word; }
		</style>";
		$sql = "select * from Ticket_Main where id = '$MainId'";
			$query = mysqli_query($con,$sql);
			$arr = mysqli_fetch_array($query);
			$issue = $arr['request'];
			$subject = $arr['subject'];
			$date = $arr['date'];
			$author = $arr['author'];
			$complete = $arr['complete'];
			$attachment = $arr['attachment'];
			$link = substr($attachment,10);
			$link2 = '../' . 'Output/'.$link;
		echo '<div id = "comment">';
		echo "<div style = 'border-bottom-style: solid;border-bottom-width:1px;'><p class = 'word'>" . $issue . "</p>";
		if($link !=null){
		echo "<p class = 'word info'>" . $author . ' ' . $date . "</br><a target = '_blank' href = '$link2' >uploaded file</a></p></div>";}else{
			echo "<p class = 'word info'>" . $author . ' ' . $date . "</p></div>";
		}
		$sql2 = "select * from Ticket_Message where Ticket_Main_id = '$MainId'";
		$query2 = mysqli_query($con,$sql2);
		while ($row = mysqli_fetch_array($query2)){
			$message = $row['message'];
			$auth = $row['auth'];
			$date = $row['date'];
			$attachment = $row['attachment'];
			$link3 = substr($attachment,10);
			$link4 = '../' . 'Output/'.$link3;
			echo "<div style = 'border-bottom-style: solid; border-bottom-width: 1px;'>";
			echo "<p class = 'word'>" . $message . "</p>";
			if($link3 != null){echo "<p class = 'word info'>" . $author . ' ' . $date . "</br><a target = '_blank' href = '$link4' >uploaded file</a></p>";}else{
				echo "<p class = 'word info'>" . $auth . ' ' . $date . "</p>";
			}
			echo "</div>";
		}
		echo '</div>';
?>
