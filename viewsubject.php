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
?>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">

  <title>Subject-List</title>
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
    <?php
    if(isset($_GET['sem'])){
        $sem=$_GET['sem'];
        $email = $_SESSION['username'];
        $sqlq ="SELECT department from users where email='$email'";
        $rest = mysqli_query($conn, $sqlq);
        $rowss = mysqli_fetch_assoc($rest);
        $udep = $rowss['department'];
        $sqry="SELECT * from academicyear order by sno desc limit 1";
        $se = mysqli_query($conn, $sqry);
        $rows = mysqli_fetch_assoc($se);
        $yr = $rows['year'];
        $se = $rows['sem'];
    }
    ?>
    <div>
    <center>
        <h2><b>Anna University Regional Campus - Tirunelveli</b></h2>
        <h3><b>Department of <?php echo $udep;?></b></h3>
        <h3><b>Academic Year - <?php echo $yr;?></b></h3><br>

    </center>
	<table class="table table-bordered table-light">
        <thead>
            <tr>
                <th colspan="6"><center>Theory</center></th>
            </tr>
            <tr>
                <th scope="col">SI.No</th>
                <th scope="col">Semester</th>
                <th scope="col">Department</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Title</th>
                <th scope="col" width="20%">Staff Name</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        		if(isset($_GET['sem'])){
                $lf1 = "SELECT semester, todepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and sem = '$se' and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures != 0 and practicals = 0)";
                $lf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and sem = '$se') and lectures != 0 and practicals = 0";
                $pf1 = "SELECT semester, todepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and sem = '$se' and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures = 0 and practicals != 0)";
                $pf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and sem = '$se') and lectures = 0 and practicals != 0";
                $f3 = "SELECT * from electives where year = '$yr' and sem = '$se' and department ='$udep'";
				$lres1 = mysqli_query($conn, $lf1);
                $lres2 = mysqli_query($conn, $lf2);
                $pres1 = mysqli_query($conn, $pf1);
                $pres2 = mysqli_query($conn, $pf2);
                $eres = mysqli_query($conn, $f3);
                $number = 1;
                if($lres1 && $lres2 && $eres){
                while ($row = mysqli_fetch_array($lres1)) {
                        $sem = $row['semester'];
                        $dep = $row['todepartment'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                while ($row = mysqli_fetch_array($lres2)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                while ($row = mysqli_fetch_array($eres)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
            }?>
            <tr>
                <th colspan="6"><center>Laboratory</center></th>
            </tr><?php
            if($pres1 && $pres2){
                while ($row = mysqli_fetch_array($pres1)) {
                        $sem = $row['semester'];
                        $dep = $row['todepartment'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                while ($row = mysqli_fetch_array($pres2)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
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
