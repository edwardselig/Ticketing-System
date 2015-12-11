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

/*$sql = "DROP TABLE Employee";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table: employee' . mysql_error());
}
echo "Table deleted successfully\n";
$sql = "DROP TABLE Department";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table: Department' . mysql_error());
}
echo "Table deleted successfully\n";
$sql = "DROP TABLE Ticket_Main";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table: main' . mysql_error());
}
echo "Table deleted successfully\n";
$sql = "DROP TABLE Issue";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table issue: ' . mysql_error());
}
echo "Table deleted successfully\n";
$sql = "DROP TABLE TransAct";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table: ' . mysql_error());
}
echo "Table deleted successfully\n";
$sql = "DROP TABLE Ticket_Message";
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete table: ' . mysql_error());
}
echo "Table deleted successfully\n";
$ticket="CREATE TABLE Ticket_Main (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	request text NOT NULL,
	subject VARCHAR(255) NOT NULL,
	priority VARCHAR(255) not null,
	issue_id INT(11) not null,
	date datetime not null,
	author VARCHAR(255) not null,
	email VARCHAR(255) not null,
	attachment VARCHAR(255),
	receiver VARCHAR(255) not null,
	complete INT(2) not null,
	updated datetime,
	date_comp datetime
)";
if ($con->query($ticket) === TRUE) {
  	echo "Table test_table created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}
$Issue="CREATE TABLE Issue (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	issue_name VARCHAR(255) not null,
	issue_description VARCHAR(255) not null,
	department_id INT(11) not null
)";
if ($con->query($Issue) === TRUE) {
  	echo "Table test_table created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}
$Department="CREATE TABLE Department (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Department_name VARCHAR(255) not null
)";
if ($con->query($Department) === TRUE) {
  	echo "Table test_table created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}

$Employee="CREATE TABLE Employee (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) not null,
	first VARCHAR(255) not null,
	last VARCHAR(255) not null,
	pass VARCHAR(255) not null,
	department_id INT(11) not null
)";
if ($con->query($Employee) === TRUE) {
  	echo "Table test_table created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}
$TransAct="CREATE TABLE TransAct (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	date_complete datetime not null,
	Ticket_Main_id INT(11) not null,
	iscomplete bool not null,
	request_sender VARCHAR(255) not null,
	request_receiver VARCHAR(255) not null
)";
if ($con->query($TransAct) === TRUE) {
  	echo "Table test_table created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}
$Ticket_Message="CREATE TABLE Ticket_Message (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	Ticket_Main_id INT(11) not null,
	date datetime not null,
	auth VARCHAR(255) not null,
	message text not null,
	attachment VARCHAR(255)
)";
if ($con->query($Ticket_Message) === TRUE) {
  	echo "Table Ticket_Message created successfully";
} else {
  	echo "Error creating table: " . $con->error;
}


$insert8 = "insert into Issue (issue_name, department_id,issue_description) values ('Listing Discrepancy',2,'When a product can be listed as FBA vs FBM
Asin mismatch
Wrong image Is attached
Inaccurate component listing
Listing marked inactive	
Price error')"; //operations
			$run_insert8 = mysqli_query($con,$insert8);
			if($run_insert8){echo "Listing Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
$insert9 = "insert into Issue (issue_name, department_id,issue_description) values ('Manufacturing Discrepancy',1,'Wrong product number')"; //buyers
			$run_insert9 = mysqli_query($con,$insert9);
			if($run_insert9){echo "Manufacturing Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			$insert6 = "insert into Issue (issue_name, department_id,issue_description) values ('PO Discrepancy',6,'Under Received PO
Inventory went to wrong location
PO not sent to warehouse
PO inventorey received at wrong location
No PO number
Mismatched Inventory
Damaged Product')"; //logistics
			$run_insert6 = mysqli_query($con,$insert6);
			if($run_insert6){echo "PO Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			$insert3 = "insert into Issue (issue_name, department_id,issue_description) values ('Program Glitch',3,'Problem with program')"; //IT
			$run_insert3 = mysqli_query($con,$insert3);
			if($run_insert3){echo "Program Glitch inserted";}
			else{echo "error: " . $con->error;}
			
			$insert4 = "insert into Issue (issue_name, department_id,issue_description) values ('Receiving Discrepancy',6,'Received the wrong units')"; //Logistics
			$run_insert4 = mysqli_query($con,$insert4);
			if($run_insert4){echo "Receiving Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			 $insert5 = "insert into Issue (issue_name, department_id,issue_description) values ('RMA Discrepancy',4,'Item not received on return
Received different sku
Received different quantities
Not received at all')"; //Customer Service
			$run_insert5 = mysqli_query($con,$insert5);
			if($run_insert5){echo "RMA Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			$insert2 = "insert into Issue (issue_name, department_id,issue_description) values ('Sales Discrepancy',3,'oversold on a channel')"; //IT
			$run_insert2 = mysqli_query($con,$insert2);
			if($run_insert2){echo "Sales Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			$insert1 = "insert into Issue (issue_name,department_id,issue_description) values ('Shipping Discrepancy',6,'Item shipped to wrong place
Not shipped
Hasnt shipped in 24 hours
Item shipped to wrong Location
No tracking')"; //Logistics
			$run_insert1 = mysqli_query($con,$insert1);
			if($run_insert1){echo "Shipping Discrepancy inserted";}
			else{echo "error: " . $con->error;}
			
			$insert1 = "insert into Department (Department_name) values ('Buyers')";
			$run_insert1 = mysqli_query($con,$insert1);
			$insert2 = "insert into Department (Department_name) values ('Operations')";
			$run_insert1 = mysqli_query($con,$insert2);
			$insert3 = "insert into Department (Department_name) values ('IT')";
			$run_insert1 = mysqli_query($con,$insert3);
			$insert4 = "insert into Department (Department_name) values ('Customer Service')";
			$run_insert1 = mysqli_query($con,$insert4);
			$insert5 = "insert into Department (Department_name) values ('HR')";
			$run_insert1 = mysqli_query($con,$insert5);
			$insert6 = "insert into Department (Department_name) values ('Logistics')";
			$run_insert1 = mysqli_query($con,$insert6);
			
			/*$insert1 = "insert into Employee (email, first, last, department_id) values ('alana@quantum-co.com','Alana', 'Cohen',1)"; //buyers
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('tuvyah@quantum-co.com','Tuvyah', 'Schleifer',1)"; //buyers
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('marc@quantum-co.com','Marc', 'Toledano',3)"; //IT
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('sam.green@quantum-co.com','Sam', 'Green',3)";  //IT
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('eddygonzalez@quantum-co.com','Eddy', 'Gonzalez',6)";  //logistics
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('elyssa@quantum-co.com','Elyssa', 'Greenfield',2)"; //operations
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('diveka@quantum-co.com','Diveka', 'Persuad',1)"; //buyers
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('jonathon@quantum-co.com','Jonathon', 'Goldman',2)"; //operations
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('Bita@quantum-co.com','Bita', 'Goldman',5)"; //HR
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('Eytan@quantum-co.com','Eytan', 'Weiner',2)"; //operation
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('Joey@quantum-co.com','Joey', 'Berkovitz',3)";// IT
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('koby.mozes@quantum-co.com','Koby', 'Mozes',1)"; //buyer
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('sean.carney@quantum-co.com','Sean', 'Carney',1)"; //buyer
			$run_insert1 = mysqli_query($con,$insert1);
			$insert1 = "insert into Employee (email, first, last, department_id) values ('melissa@quantum-co.com','Melissa', 'Greengus',4)";
			$run_insert1 = mysqli_query($con,$insert1);*/ // Customer Service

	if (isset($_GET['id'])) {
    	$id = $_GET['id'];
    	$date1 = date("Y-m-d H:i:s");
    	$sql = "UPDATE Ticket_Main SET complete = '1' WHERE id='$id'";
    	//$sql1 = "UPDATE TransAct SET iscomplete = 1 WHERE Ticket_Main_id='$id'";
    	$sql2 = "UPDATE Ticket_Main SET date_comp = '$date1' WHERE id='$id'";
    	$sql3 = "UPDATE Ticket_Main SET updated = '$date1' WHERE id='$id'";
    	if ($con->query($sql) === TRUE) {
   			 echo "<h1>Ticket updated successfully<h1>";
			} else {
    		echo "Error updating record: " . $con->error;
    	}
    	/*if ($con->query($sql1) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}*/
			if ($con->query($sql2) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
			if ($con->query($sql3) === TRUE) {
			} else {echo "Error updating record: " . $con->error;}
    	$date1 = date("Y-m-d H:i:s");
		$insert = "insert into TransAct (date_complete) values ('$date1')";
		$run_insert = mysqli_query($con,$insert);
    	}else{
	$sql = "select first, last from Employee where email = '$email'";
	$query = mysqli_query($con,$sql);
	$arr = mysqli_fetch_array($query);
	
	$issue = $_POST['issue'];
	$priority = $_POST['priority'];
	$subject = $_POST['subject'];
	$date = date("Y-m-d H:i:s");
	$type1 = $_POST['type1'];
	$IT = $_POST['IT'];
	$Logistics = $_POST['Logistics'];
	$Operations = $_POST['Operations'];
	$CustomerService = $_POST['CustomerService'];
	$Buyers = $_POST['Buyers'];
	$file = $_POST['photo'];
	$receiver;
	
	$target = "../Output/";
		$target = $target . basename( $_FILES['photo']['name']);
		if(move_uploaded_file($_FILES['photo']['tmp_name'],$target)){
		}else{}
		
	if($type1=='Program Glitch'){
		$receiver = $IT;
	}
	if($type1=='Listing Discrepancy'){
		$receiver = $Operations;
	}
	if($type1=='Manufacturing Discrepancy'){
		$receiver = $Buyers;
	}
	if($type1=='PO Discrepancy'){
		$receiver = $Logistics;
	}
	if($type1=='Receiving Discrepancy'){
		$receiver = $Logistics;
	}
	if($type1=='RMA Discrepancy'){
		$receiver = $CustomerService;
	}
	if($type1=='Sales Discrepancy'){
		$receiver = $IT;
	}
	if($type1=='Shipping Discrepancy'){
		$receiver = $Logistics;
	}
	$author = $arr['first'] . ' ' . $arr['last'];
	
		if($issue != null&& $type1 != null){
			$sel = "select id from Issue Where issue_name='$type1'";
			$run1 = mysqli_query($con,$sel);
			$res = mysqli_fetch_array($run1, MYSQLI_NUM);
			$run = $res[0];
			$insert = "insert into Ticket_Main (subject,request,date,priority,issue_id,author,complete,receiver,email,attachment) values ('$subject','$issue', '$date','$priority','$run','$author','0','$receiver','$email', '$file')";
			$run_insert = mysqli_query($con,$insert);
			
			$sel1 = "select id from Ticket_Main Where date='$date'";
			$run2 = mysqli_query($con,$sel1);
			$res1 = mysqli_fetch_array($run2, MYSQLI_NUM);
			$MainId = $res1[0];
			
			$d = date("Y-m-d H:i:s");
			$insert1 = "insert into TransAct (date_complete,Ticket_Main_id,iscomplete,request_sender,request_receiver) values ('$d','$MainId','0','$author','$receiver')";
			$run_insert1 = mysqli_query($con,$insert1);
			if($run_insert){}
			else{echo "error: " . $con->error;}
			
				$to = $receiver;
				$subject1 = $priority .' ' . $subject . ' Ticket #' . $MainId; //what is a good subject format?
				$message =		
"
Priority: $priority
Type of issue: $type1
Issue description: $issue

Please click the following link to mark the ticket as being resolved:
http://quantum-co.com/Internship_Program/Edward/Project_5/Resources/Ticket.php?Ticket=".$MainId; 

				$from = "From: " . $author. "  <'$email'>";
				mail($to,$subject1,$message,$from);
			
		}
		}
	mysqli_close($con);
?>
