<?php
session_start();
$email = $_SESSION['email'];
if($email ==null){die(header( 'Location: http://quantum-co.com/Internship_Program/Edward/Project_5/Input/LogIn.php' ));}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>IssueReport</title>
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
				border-color: #0000E6;
				border-width: 2px;
				background-color: #FFFFFF;
				width: 600px;
				height: 632px;
				border-radius: 10px;
			}
			.word{
				color: #3D8ACB;
				font-family: sans-serif;
			}
			.buttons{
				background-color: white;
				border-radius: 5px;
			}
			.receiver{
				margin: 0px 248px 0px 248px;
			}
		</style>
		<script>
		$.post("Toolbar.php",{},function(data){
						$("#tool").html(data);
					});
			$(document).ready(function(){
			$('#myForm').ajaxForm(function() { 
            }); 
				$("#type1").change(function(){
					$('#IT1').hide();
					$('#Operations1').hide();
					$('#Logistics1').hide();
					$('#CustomerService1').hide();
					$('#Buyers1').hide();
					var type = $("#type1").val();
					if(type=='Program Glitch'){
						$('#IT1').show();
					}
					if(type=='Listing Discrepancy'){
						$('#Operations1').show();
					}
					if(type=='Manufacturing Discrepancy'){
						$('#Buyers1').show();
					}
					if(type=='PO Discrepancy'){
						$('#Logistics1').show();
					}
					if(type=='Receiving Discrepancy'){
						$('#Logistics1').show();
					}
					if(type=='RMA Discrepancy'){
						$('#CustomerService1').show();
					}
					if(type=='Sales Discrepancy'){
						$('#IT1').show();
					}
					if(type=='Shipping Discrepancy'){
						$('#Logistics1').show();
					}
				});
				$("#sub").click(function(){
				
					var user_issue = $("#issue").val();
					var user_priority = $("#priority").val();
					var user_subject = $("#subject").val();
					var user_type = $("#type1").val();
					var user_IT = $("#IT").val();
					var user_Operations = $("#Operations").val();
					var user_Logistics = $("#Logistics").val();
					var user_CustomerService = $("#CustomerService").val();
					var user_Buyers = $("#Buyers").val();
					var fil = document.getElementById("photo");
					var file = fil.value;
					$.post("BugReport.php",{photo: file, subject: user_subject,Buyers:user_Buyers,CustomerService:user_CustomerService,Logistics:user_Logistics,Operations:user_Operations,issue:user_issue,priority:user_priority,type1:user_type,IT:user_IT},function(data){
						$("#result").html(data);
					});
					document.getElementById('issue').value='';
					document.getElementById('subject').value='';
					setTimeout(function(){
						document.getElementById('photo').value='';
					},50);
					//document.getElementById('photo').value='';
					$('#type1').prop('selectedIndex', 0);
					$('#priority').prop('selectedIndex', 1);
					$('#IT1').hide();
					$('#Operations1').hide();
					$('#Logistics1').hide();
					$('#CustomerService1').hide();
					$('#Buyers1').hide();
						
				});
			});
		</script>
	</head>
	<body>
		<div id = "tool"></div>
		<div id="box">
		<h3 class = "word" style = "font-family: sans-serif; margin:10px 220px 30px 240px;">Issue Report</h3>
		<div class = "word" style = "margin: 0px 245px 0px 245px">Type Of Issue:</div>
			<div style = " max-width: 150px; margin-left: auto; margin-right: auto; padding: 2px">
			<form action= "BugReport.php" method="post">
			<select class = "buttons" name = "type1" id = "type1" style = 'max-width: 150px;'>
			<?php
					$servername = "localhost";
					$username = "quantco_Ted";
					$password = "Quantum1";
					$database = "quantco_Interns";

					$con = mysqli_connect($servername,$username,$password,$database);
						if($con->connect_error){
						die("Connection failed " . $con->connect_error);
					}
				$sql1 = "select issue_name, issue_description from Issue";
				$result = mysqli_query($con,$sql1);
				echo "<option value = ''></option>";
				while ($row = mysqli_fetch_array($result)) {
    				$issue = $row['issue_name'];
    				$des = $row['issue_description'];
    				echo "<option value = '$issue' title = '$des'>$issue</option>";
					}
			?>
			</select>
			</form></div>
		<form action="BugReport.phpl" method="post">
		<div id = "Buyers1" style = "display:none;"><select class = "buttons receiver" name = "Buyers" id = "Buyers">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 1";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
					}
				?>
			</select></div></form>
			<div id = "Operations1" style = "display:none;"><form action="BugReport.php" method="post">
		<select class = "buttons receiver" name = "Operations" id = "Operations">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 2";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
    					
					}
				?>
			</select></form></div>
			<div id = "IT1" style = "display:none;"><form action="BugReport.php" method="post">
		<select class = "buttons receiver" name = "IT" id = "IT"">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 3";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
    					
					}
				?>
			</select></form></div>
			<div id = "CustomerService1" style = "display:none;"><form action="BugReport.html" method="post">
		<select class = "buttons receiver" name = "CustomerService" id = "CustomerService">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 4";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
    					
					}
				?>
			</select></form></div>
			<div id = "HR1" style = "display:none;"><form action="BugReport.html" method="post">
		<select class = "buttons receiver" name = "HR" id = "HR">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 5";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
    					
					}
				?>
			</select></form></div>
			<div id = "Logistics1" style = "display:none;"><form action="BugReport.html" method="post">
		<select class = "buttons receiver" name = "Logistics" id = "Logistics">
				<?php 
					$sql = "select first, last, email from Employee where department_id = 6";
					$result = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result)) {
    					$name = $row['first'] . ' ' . $row['last'];
    					$email = $row['email'];
    					echo "<option value = '$email'>$name</option>";
					}
				?>
			</select></form></div>
		<div class = "word" style = "margin: 0px 265px 0px 265px">Subject</div>
		<form action="BugDisplayAndReply.html" method="post">
		<input style = "margin: 0px 235px 0px 235px" type ="text" name="subject" id="subject" placeholder="Subject"/></br>
		<label></label><br>
		<textarea style = "margin: auto 0; max-width: 590px; max-height: 400px; background-color: white; border-color: #0000E6;" cols="83" rows="25" name="issue" id = "issue" placeholder = "Enter Your Issue Here" "></textarea></form><br>
			<div class = "word" style = "width: 50px; margin-left: auto; margin-right: auto">Priority:</div>
			<div style = "width: 70px; margin-left: auto; margin-right: auto; padding: 2px">
			<form action="BugReport.html" method="post">
			<select class = "buttons" name = "priority" id = "priority">
				<option value = "Low">Low</option>
				<option value = "Regular" selected>Regular</option>
				<option value = "High">High</option>
				<option value = "Urgent">Urgent</option>
			</select>
			</form></div>
				<form method="post" action="BugReport.php" enctype="multipart/form-data" id = 'myForm'>
                	<div style = 'margin: 10px 225px 0px 225px;'>
                		<input type="file" id = "photo" name="photo"/> </div>
                	<div style = "width: 50px; margin-left: auto; margin-right: auto; padding: 2px">
        				<input style = 'margin: 10px 0px 0px 0px;' class = "buttons" type ="submit" name = "sub" value = "Submit" id = "sub"/></div>
       			</form>
		<div id="result"></div>
		</div>
	</body>
</html>
