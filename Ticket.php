<?php
session_start();
$email = $_SESSION['email'];
if($email ==null){die(header( 'Location: http://quantum-co.com/Internship_Program/Edward/Project_5/Input/LogIn.php' ));}
$MainId;
if (isset($_GET['Ticket'])) {
	$MainId = $_GET['Ticket'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Ticket</title>
		<script src = "../../jquery.js"></script>
		<script src="form.js"></script> 
		<style>
			body{
				padding:0;
				margin:0;
				background-color:#3D8ACB;
			}
			#box {
				padding: 5px;
				color:black;
				margin: 0 auto;
				border-style: solid;
				border-color: black;
				border-width: 2px;
				background-color: #FFFFFF;
				width: 600px;
				
				border-radius: 10px;
			}
			.word{
				font-family: sans-serif;
			}
			.info{
				font-size: 12px;
			}
			.buttons{
				background-color: white;
				border-radius: 5px;
			}
			.receiver{
				margin: 0px 248px 0px 248px;
			}
			p { word-wrap: break-word; }
		</style>
		<script>
			$(document).ready(function(){
				$("#MainId").hide();
				$('#myForm').ajaxForm(function() { 
            }); 
            	$.post("Toolbar.php",{},function(data){
						$("#tool").html(data);
					});
				$("#sub").click(function(){
					var user_message = $('#message').val();
					var Main = $('#MainId').val();
					var user_complete = $('#complete').val();
					var fil = document.getElementById("photos");
					var file = fil.value;
					$.post("TicketHelper.php",{photos:file, complete: user_complete, MainId: Main, message:user_message},function(data){
						$("#result").html(data);
					});
					document.getElementById('message').value='';
					//document.getElementById('photos').value='';
					location.reload(true);
				});
			});
		</script>
	</head>
	<body>
		<select id = "MainId"> <?php echo "<option>" . $MainId . "</option>"; ?> </select>
		<div id = "tool"></div>
		<div id="box">
		<div id = "issue" style = 'border-bottom-style: solid;border-bottom-width:1px;'><?php 
			$email = $_SESSION['email'];
			$servername = "localhost";
			$username = "quantco_Ted";
			$password = "Quantum1";
			$database = "quantco_Interns";

			$con = mysqli_connect($servername,$username,$password,$database);
			if($con->connect_error){
				die("Connection failed " . $con->connect_error);
			}
			$sql = "select * from Ticket_Main where id = '$MainId'";
			$query = mysqli_query($con,$sql);
			$arr = mysqli_fetch_array($query);
			$issue = $arr['request'];
			$subject = $arr['subject'];
			$date = $arr['date'];
			$author = $arr['author'];
			$complete = $arr['complete'];
			$attachment = $arr['attachment'];
			echo "<p class = 'word'>" . $subject . "</p>";
			$link = substr($attachment,10);
			$link2 = '../' . 'Output/'.$link;
			echo "<p class = 'word info'>". $author . " " . $date . "</p>";
		?></div>
		<form action= "TicketHelper.php" method="post">
		<textarea style = "margin: auto 0; max-width: 590px; max-height: 400px; background-color: white; border-color: black" cols="83" rows="5" name="message" id = "message" placeholder = "Enter Your Issue Comment" "></textarea><br>
			<div style = "width: 50px; margin-left: auto; margin-right: auto; padding: 2px">
		<select style = 'margin: 10px 0px 0px -30px;' id = 'complete'>
			<?php if($complete == '0'){
			echo "<option value = '0'>Unresolved</option>
			<option value = '2'>Being Resolved</option>
			<option value = '1'>Resolved</option>";
			}
			if($complete == '2'){
			echo "<option value = '0'>Unresolved</option>
			<option value = '2' selected = 'selected'>Being Resolved</option>
			<option value = '1'>Resolved</option>";
			} 
			if($complete == '1'){
			echo "<option value = '0'>Unresolved</option>
			<option value = '2'>Being Resolved</option>
			<option value = '1' selected = 'selected'>Resolved</option>";
			} ?>
		</select>
		</div></form>
		<form method="post" action="TicketHelper.php" enctype="multipart/form-data" id = 'myForm'>
                <div style = 'margin: 10px 225px 0px 225px;'>
                <input type="file" id = "photos" name="photos"/> </div>
                <div style = "width: 50px; margin-left: auto; margin-right: auto; padding: 2px">
        <input style = 'margin: 10px 0px 0px 0px;' class = "buttons" type ="submit" name = "sub" value = "Submit" id = "sub"/></div>
        </form>
		<h3 style='text-align: center' class = 'word'>Enter Comment</h3>
		<div id = "display"></div>
		<div id = "comment">
		<?php 
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
		?>
		</div>
		<div id="result"></div>
		</div>
	</body>
</html>
