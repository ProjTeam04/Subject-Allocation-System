<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

$sqry="SELECT * from academicyear order by sno desc limit 1";
$se = mysqli_query($conn, $sqry);
$rows = mysqli_fetch_assoc($se);
$yr = $rows['year'];
$se = $rows['sem'];

if(isset($_GET['dep']) && isset($_GET['totalstaff']) && isset($_GET['lab']) && isset($_GET['theory'])){
	$dep = $_GET['dep'];
	$totalstaff = $_GET['totalstaff'];
	$lab = $_GET['lab'];
	$theory = $_GET['theory'];

	$query = "INSERT INTO staffreq (year,sem,department,laboratory,theory,totalstaff) VALUES ('$yr','$se','$dep','$lab','$theory','$totalstaff')";
	$result = mysqli_query($conn, $query);
	if($result){
		header("Location: listgeneration.php");
	}
}

?>