<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">

  <title>Subject-List</title>
  <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!---Home-->
             <ul class="navbar-nav me-auto order-0">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="home.php"><i class="fa fa-home" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Home</a>
                </li>

                <li class="nav-item active">


                    <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-pencil" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Subject-Allocation</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--- semester backend-->
        <center>
            <div class="card w-25" style="width: 18rem; margin: 0 auto">
            <div class="card-body">
            <h3><b>Academic Year</b></h3>
            <?php  
                 $yr="SELECT * from academicyear order by sno desc limit 1";
                 $qry_run = mysqli_query($conn, $yr);
                 $row = mysqli_fetch_assoc($qry_run);
                 echo '<h3><b>'.$row['year'].' - '.$row['sem'].' semester</b></h3>';
    ?>
    </div>
  </div>
    <br>
    <!--- semester selection end-->
        <h2><b><u>Subject List</u></b></h2>
        <table class="table table-bordered table-primary">
          <thead>
            <tr>
              <th scope="col">SI.No</th>
              <th scope="col">Semester</th>
              <th scope="col">Department</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sqry="SELECT * from academicyear order by sno desc limit 1";
                $sem = mysqli_query($conn, $sqry);
                $rows = mysqli_fetch_assoc($sem);
                $yr = $rows['year'];
                $semes = $rows['sem'];
                //$rows1 = mysqli_fetch_assoc($res));
                $email = $_SESSION['username'];
                $sqlq ="SELECT department from users where email='$email'";
                $rest = mysqli_query($conn, $sqlq);
                $rowss = mysqli_fetch_array($rest);
                $udep = $rowss['department'];
                $number = 1;

                if($rows['sem'] == 'even'){
                  $semr = 2;
                  while($number <= 4){
                    echo'<tr>
                    <td>'.$number.'</td>
                    <td>'.$semr.'</td>
                    <td>'.$udep.'</td>
                    <td><button type="button" class="btn btn-danger"><a href="viewsubject.php?sem='.$semr.'" class="text-light">View</a></button></td>
                    </tr>';
                    $number++;
                    $semr = $semr + 2;
                  }
                }
                else if($rows['sem'] == 'odd'){
                     $semr = 1;
                  while($number <= 4){
                    echo'<tr>
                    <td>'.$number.'</td>
                    <td>'.$semr.'</td>
                    <td>'.$udep.'</td>
                    <td><button type="button" class="btn btn-danger"><a href="viewsubject.php?sem='.$semr.'" class="text-light">View</a></button></td>
                    </tr>';
                    $number++;
                    $semr = $semr + 2;
                  }
                }
              ?>
          </tbody>
        </table>
      </center>
                        
</body>
</html>

