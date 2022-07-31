<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
    include("auth_session.php");
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
    $sqry="SELECT * from academicyear order by sno desc limit 1";
        $se = mysqli_query($conn, $sqry);
        $row = mysqli_fetch_assoc($se);
        $yr = $row['year'];
        $sem = $row['sem'];
?>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">

  <title>List</title>
  <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css" media="print">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    
    <div>
    <center>
        <h2><b>Anna University Regional Campus - Tirunelveli</b></h2>
        <?php echo '<h3><b>Academic Year : '.$row['year'].' - '.$row['toyear'].'<br><br>'; 
                 echo 'Semester : '.$row['sem'].'</b></h3>';?>

    </center>
	<table class="table table-bordered table-light">
        <thead>
            
            <tr>
                <th scope="col">SI.No</th>
                <th scope="col">Department</th>
                <th scope="col">Theory</th>
                <th scope="col">Practical</th>
                <th scope="col" width="20%">No of staff required</th>
            </tr>
        </thead>
        <tbody>
        	   <?php
                    $query = "SELECT * from staffreq where year = '$yr' and sem = '$sem'";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result)){
                        $no=1;
                        while($rows = mysqli_fetch_array($result)){
                            $dep = $rows['department'];
                            $totalstaff = $rows['totalstaff'];
                            $lab = $rows['laboratory'];
                            $theory = $rows['theory'];
                            echo '<tr>

                                <td>'.$no.'</td>
                                <td>'.$dep.'</td>
                                <td>'.$theory.'</td>
                                <td>'.$lab.'</td>
                                <td>'.$totalstaff.'</td>
                            </tr>';
                            $no++;
                        }
                    }
               ?>
        </tbody>
    </table>
<div class="text-center">
        <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
</div>
</body>
</html>
