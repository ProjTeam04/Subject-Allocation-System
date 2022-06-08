<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
	$host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname= "suball";

    //create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    if(mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
    }
    else{
    	if(isset($_GET['deleteid'])){
			$sno=$_GET['deleteid'];
			$sql="delete from subjects where sno=$sno";
			$result=mysqli_query($conn,$sql);
			if($result){
				?><script> alert("Do you want to delete the record?"); </script><?php
				header('location:subject1.php');
			}    		
			else{
				die(mysqli_error($conn));
			}
    	}
    }
?>

