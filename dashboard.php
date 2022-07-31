<!-----AUTH SESSION STARTS-------------->
<?php
//include auth_session.php file on all user panel pages
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
include("auth_session.php");
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (isset($_POST['setyear'])){
                    $year = $_POST['year'];
                    $toyear = $_POST['toyear'];
                    $sem = $_POST['sem'];
                    $INSERT1 = "INSERT Into academicyear (year,toyear,sem) values(?,?,?)";
                    $stmt = $conn->prepare($INSERT1);
                    $stmt->bind_param("iis", $year,$toyear,$sem);
                    $stmt->execute();
                    header("Location: dashboard.php");
                    $stmt->close();
                 }
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fetch.js"></script>
</head>

<body>

    <!--Nav Starts-->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!---Home-->
            <ul class="navbar-nav me-auto order-0">

                <li class="nav-item active">
                    <a class="nav-link text-white" href="dashboard.php"><i class="fa fa-home" style="font-size:29px"></i><span class="sr-only">(current)</span> Home</a>
                </li>
                
            </ul>
        </div>

        <?php
        if (isset($_SESSION['username'])) {
            echo ' <li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Logout </a>
        </li>';
        } else {
            '<li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="adminlogin.php"><i class="fa fa-sign-in" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Login </a>
        </li>';
        }
        ?>
    </nav>
    <!--Nav Ends---->
    <!-----------------NAV BAR ENDS---------------------->
    <!----------------TITLE TAG STARTS-------------------------->
    
    <center><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160"></center>
    <br>
    <center>
        <h1 style="color: black ;">Welcome Admin !!</b></h1>
    </center>

    <!----------------TITLE TAG ENDS-------------------------->
    <br>
    <center >
            <?php  
                 $yr="SELECT * from academicyear order by sno desc limit 1";
                 $qry_run = mysqli_query($conn, $yr);
                 $row = mysqli_fetch_assoc($qry_run);
                 echo '<h3><b>Academic year : '.$row['year'].' - '.$row['toyear'].' '.$row['sem'].' semester</b></h3>';
            ?>
        </center>
        <br><br>
    <div class="card w-25" style="width: 18rem; margin: 0 auto">
            <div class="card-body">
                <center>
                    <h3>Set Current Academic year</h3>   
                    <!--Popup Form for subjects-->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Set</button>
                    <h3>View List Generated</h3>
                    <form action="Adminlist.php">
                        <button class="btn btn-primary">View</button>
                    </form>
                </center>
            </div>
        </div><br><br>
<!-- popup starts-->
                    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" style="margin: 0 auto"><b>Current Academic Year details</b></h1>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="col" width="50%">
                                                        <div class="form-group">
                                                            <label>From year</label>
                                                            <input class="form-control mr-sm-2" type="text" name="year" value="" placeholder="Academic year" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>To year</label>
                                                            <input class="form-control mr-sm-2" type="text" name="toyear" value="" placeholder="Academic year" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Semester</label>
                                                            <select class="form-control" name="sem" required="">
                                
                                                                <option value="">Select semester</option>
                                                                <option value="odd">Odd</option>
                                                                <option value="even">Even</option>
                                                            </select>
                                                            
                                                            <span></span>
                                                        </div>
                    
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-success my-2 my-sm-0 btn-primary" type="submit" name="setyear">Set</button>
                                                    <!--<input class="btn btn-primary" type="submit" value="Submit">-->
                                                    <input class="btn btn-danger" type="reset" value="Clear">
                                                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        <!-- popup ends-->

</body>

</html>

