<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
<<<<<<< HEAD
=======

//include auth_session.php file on all user panel pages
include("auth_session.php");
$email = $_SESSION['username'];
$sqlq ="SELECT department from users where email='$email'";
$rest = mysqli_query($conn, $sqlq);
$rowss = mysqli_fetch_array($rest);
$udep = $rowss['department'];
if (isset($_POST['suballot'])) {
            $todep = $_POST['todepartment'];
            $stat = 'sent';
            $query = "SELECT * from subjects Where coursecode = '$cc' and department = '$dep'";
            $query1="SELECT * from academicyear order by sno desc limit 1";
            $qry_run = mysqli_query($conn, $query);
            $qry_run1 = mysqli_query($conn, $query1);
            $row = mysqli_fetch_assoc($qry_run);
            $row1 = mysqli_fetch_assoc($qry_run1);
            $yr = $row1['year'];
            $sem = $row1['sem'];
            $regulation = $row['regulation'];
            $semester = $row['semester'];
            $fromdepartment = $row['department'];
            $todepartment = $todep;
            $coursecode = $row['coursecode'];
            $coursetitle = $row['coursetitle'];
            $category = $row['category'];
            $status = $stat;
            $INSERT1 = "INSERT Into depwisepaper (acyear,sem,regulation,semester,fromdepartment,todepartment,coursecode,coursetitle,category,status) values(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($INSERT1);
            $stmt->bind_param("isiissssss",$yr, $sem, $regulation, $semester, $fromdepartment, $todepartment, $coursecode, $coursetitle, $category,$status);
            $stmt->execute();
            header("Location: subject-list.php");
            $stmt->close();
        }

>>>>>>> d1ff8cf9d070b34f3c46ed895125b26248452116
?>
<!DOCTYPE html>
<html>

<head>
    <title>Subject-List</title>
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
                    <a class="nav-link text-white" href="home.php"><i class="fa fa-home" style="font-size:24px"></i>Home <span class="sr-only">(current)</span></a>
                </li>
<<<<<<< HEAD

=======
>>>>>>> d1ff8cf9d070b34f3c46ed895125b26248452116
                <!-------Subject-entry--------------------------->
                <li class="nav-item active">
                    <a class="nav-link text-white" href="subject1.php">
                        <i class="fa fa-pencil" style="font-size:24px" aria-hidden="true"></i>
                        Subject-Entry <span class="sr-only">(current)</span></a>
                </li>
<<<<<<< HEAD

               
            </ul>

            <li class="nav-item button">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Received subjects</button>
                <!-- popup starts-->
                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title" style="margin: 0 auto"><b>Subject Lists</b></h1>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                    <div class="card-body">
                                        <table class="table table-bordered table-primary">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Select</th>
                                                    <th scope="col">SI.No</th>
                                                    <th scope="col">Regulation</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Course Code</th>
                                                    <th scope="col">Course Title</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col"> Assigned</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
=======
                <!--Popup Form for subjects-->

                <li class="nav-item button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sent</button>
                    <!-- popup starts-->
                    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" style="margin: 0 auto"><b>Sent Subjects</b></h1>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                        <div class="card-body">
                                           <table class="table table-bordered table-primary">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SI.No</th>
                                                    <th scope="col">Regulation</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">To Department</th>
                                                    <th scope="col">Course Code</th>
                                                    <th scope="col">Course Title</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col"> Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                
                                                
                                                $sqry="SELECT * from academicyear order by sno desc limit 1";
                                                $sem = mysqli_query($conn, $sqry);
                                                $rows = mysqli_fetch_assoc($sem);
                                                $yr = $rows['year'];
                                                $semes = $rows['sem'];
                                                $qy="SELECT * from depwisepaper where acyear='$yr' and sem='$semes' and fromdepartment = '$udep' ";
                                                $res = mysqli_query($conn, $qy);
                                                $number=1;
                                                if ($res) {
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $sno = $row['sno'];
                                                        $reg = $row['regulation'];
                                                        $sem = $row['semester'];
                                                        $dep = $row['todepartment'];
                                                        $cc = $row['coursecode'];
                                                        $ct = $row['coursetitle'];
                                                        $cat = $row['category'];
                                                        $sat = $row['status'];
                                                        echo '<tr>
                                                            <td>' . $number . '</td>
                                                            <td>' . $reg . '</td>
                                                            <td>' . $sem . '</td>
                                                            <td>' . $dep . '</td>
                                                            <td>' . $cc . '</td>
                                                            <td>' . $ct . '</td>
                                                            <td>' . $cat . '</td>
                                                            <td>' . $sat . '</td>
                                                            </tr>';
                                                            $number++;
                                                         }
                                                    }
                                                ?>
                                            </tbody>
                                        </table> 
                                                
>>>>>>> d1ff8cf9d070b34f3c46ed895125b26248452116
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div>
                <!-- popup ends-->
            </li>
=======
        </div>
        </div>
        <!-- popup ends-->
        </li>

                <li class="nav-item button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalr">Received</button>
                    <!-- popup starts-->
                    <div id="myModalr" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" style="margin: 0 auto"><b>Received Subjects</b></h1>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                        <div class="card-body">
                                           <table class="table table-bordered table-primary">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SI.No</th>
                                                    <th scope="col">Regulation</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Course Code</th>
                                                    <th scope="col">Course Title</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col"> Assigned</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $sqry="SELECT * from academicyear order by sno desc limit 1";
                                                $sem = mysqli_query($conn, $sqry);
                                                $rows = mysqli_fetch_assoc($sem);
                                                $yr = $rows['year'];
                                                $semes = $rows['sem'];
                                                $qy="SELECT * from depwisepaper where acyear='$yr' and sem='$semes' and todepartment = '$udep'";
                                                $res = mysqli_query($conn, $qy);
                                                $number=1;
                                                if ($res) {
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $sno = $row['sno'];
                                                        $reg = $row['regulation'];
                                                        $sem = $row['semester'];
                                                        $dep = $row['fromdepartment'];
                                                        $cc = $row['coursecode'];
                                                        $ct = $row['coursetitle'];
                                                        $cat = $row['category'];
                                                        echo '<tr>
                                                            <td>' . $number . '</td>
                                                            <td>' . $reg . '</td>
                                                            <td>' . $sem . '</td>
                                                            <td>' . $dep . '</td>
                                                            <td>' . $cc . '</td>
                                                            <td>' . $ct . '</td>
                                                            <td>' . $cat . '</td>
                                                            </tr>';
                                                            $number++;
                                                         }
                                                    }
                                                ?>
                                            </tbody>
                                        </table> 
                                                
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        <!-- popup ends-->
        </li>
>>>>>>> d1ff8cf9d070b34f3c46ed895125b26248452116
            </ul>
        </div>
        <!--Search Bar-->
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search'];
                                                                                    } ?>" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 btn-dark" type="submit">Search</button>
        </form>
    </nav>
    <!--Nav Ends-->
    <!------------------- FILTER STARTS REGULATION DEPARTMENT---------------->
    <form method="post">
        <center>
            <div class="btn-group btn-group-inline">
                <div class="container">
                    <div class="row">
                        <div class="col order-first">
                            <label>Regulation</label><br>
                            <select class="form-control" name="regu" id="reg" required="">
                                <?php
                                $sql = "SELECT distinct regulation from subjects";
                                $res = mysqli_query($conn, $sql); ?>
                                <option value="">select</option><?php
                                                                while ($rows = mysqli_fetch_array($res)) {
                                                                ?>
                                    <option value="<?php echo $rows['regulation']; ?>"><?php echo $rows['regulation']; ?></option>
                                <?php
                                                                }
                                ?>
                            </select>
                        </div>
                        <div class="col order-last">
                            <label>Semester</label>
                            <select class="form-control" name="semes" id="dep">
                                <?php
                                $sql = "SELECT distinct semester from subjects";
                                $res = mysqli_query($conn, $sql); ?>
                                <option value="">select</option><?php
                                                                while ($rows = mysqli_fetch_array($res)) {
                                                                ?>
                                    <option value="<?php echo $rows['semester']; ?>"><?php echo $rows['semester']; ?></option>
                                <?php
                                                                }
                                ?>
                            </select>
                            <span></span>
                        </div>

                    </div>
                    <br>
                    <div>
                        <button class="btn btn-outline-success my-2 my-sm-0 btn-primary" type="submit" name="filtersubmit">Filter</button>

                    </div>
                </div>
        </center>
    </form>
    <!--Course Table Starts-->
    <br>
    <form method="post">
      <table class="table table-bordered table-primary">
        <thead>
            <tr>
                
                <th scope="col">SI.No</th>
                <th scope="col">Regulation</th>
                <th scope="col">Semester</th>
                <th scope="col">From Department</th>
                <th scope="col">To Department</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Title</th>
                <th scope="col">Category</th>
                <th scope="col">Operation</th>
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
                if($rows['sem'] == 'even'){
                    $sql = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'";
                }
                else if($rows['sem'] == 'odd'){
                    $sql = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'";
                }
                $qy="SELECT * from electives where year='$yr' and sem='$semes' and department = '$udep'";
                $res = mysqli_query($conn, $qy);
                $result = mysqli_query($conn, $sql);
                $number = 1;
                if (isset($_GET['search'])) {
                    $filtervalues = $_GET['search'];
                    $sqry="SELECT * from academicyear order by sno desc limit 1";
                    $sem = mysqli_query($conn, $sqry);
                    $rows = mysqli_fetch_assoc($sem);
                    $yr = $rows['year'];
                    $semes = $rows['sem'];
                    
                    if($rows['sem'] == 'even'){
                        $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'";
                    }
                    else if($rows['sem'] == 'odd'){
                        $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'";
                    }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and department = '$udep'";
                    $qry_run = mysqli_query($conn, $qry);
                    $res = mysqli_query($conn, $qy);
                    if (mysqli_num_rows($qry_run) > 0) {
                        while ($row = mysqli_fetch_assoc($qry_run)) {
                            $sno = $row['sno'];
                            $reg = $row['regulation'];
                            $sem = $row['semester'];
                            $dep = $row['department'];
                            $cc = $row['coursecode'];
                            $ct = $row['coursetitle'];
                            $cat = $row['category'];
                            echo '<tr>
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep" >
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';

                            $number++;
                        }
                        while ($row = mysqli_fetch_assoc($res)) {
                        $sno = $row['sno'];
                        $reg = $row['regulation'];
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        $cat = $row['category'];
                        echo '<tr>
                            
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep" >
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';
                        $number++;
                    }
                    } else {
                ?>
                        <tr>
                            <td colspan="13">No record found</td>
                        </tr>
                    <?php
                    }
                } else if (isset($_POST['filtersubmit'])) {
                    $regulation = $_POST['regu'];
                    $semester = $_POST['semes'];
                    $sqry="SELECT * from academicyear order by sno desc limit 1";
                    $sem = mysqli_query($conn, $sqry);
                    $rows = mysqli_fetch_assoc($sem);
                    $yr = $rows['year'];
                    $semes = $rows['sem'];
    
                
                 if(!empty($regulation) && !empty($semester)){
                    if($rows['sem'] == 'even'){
                        $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'";
                    }
                    else if($rows['sem'] == 'odd'){
                        $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'";
                    }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and regulation='$regulation' and semester='$semester' and department = '$udep'";
                }
                
                else if(!empty($regulation)){
                    if($rows['sem'] == 'even'){
                        $select = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'";
                    }
                    else if($rows['sem'] == 'odd'){
                        $select = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'";
                    }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and regulation='$regulation'";
                }
                else if(!empty($semester)){
                    if($rows['sem'] == 'even'){
                        $select = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'";
                    }
                    else if($rows['sem'] == 'odd'){
                        $select = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'";
                    }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and semester='$semester' and department = '$udep'";
                }
                    $res = mysqli_query($conn, $qy);
                    $select1 = mysqli_query($conn, $select);

                    if (mysqli_num_rows($select1) > 0) {
                        while ($row = mysqli_fetch_assoc($select1)) {
                            $sno = $row['sno'];
                            $reg = $row['regulation'];
                            $sem = $row['semester'];
                            $dep = $row['department'];
                            $cc = $row['coursecode'];
                            $ct = $row['coursetitle'];
                            $cat = $row['category'];
                            echo '<tr>
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep" >
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';
                            $number++;
                        }
                        while ($row = mysqli_fetch_assoc($res)) {
                        $sno = $row['sno'];
                        $reg = $row['regulation'];
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        $cat = $row['category'];
                        echo '<tr>
                            
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep">
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';
                        $number++;
                    }
                    } else {
                    ?>
                        <tr>
                            <td colspan="13">No record found</td>
                        </tr>
                <?php
                    }
                } else if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $row['sno'];
                        $reg = $row['regulation'];
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        $cat = $row['category'];
                        echo '<tr>
                            
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep">
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';
                        $number++;
                    }
                    while ($row = mysqli_fetch_assoc($res)) {
                        $sno = $row['sno'];
                        $reg = $row['regulation'];
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        $cat = $row['category'];
                        echo '<tr>
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td><select class="form-control" name="todepartment" id="dep" >
                                    <option value="">select</option>
                                    <option value="cse">Computer Science Engineering</option>
                                    <option value="ece">Electronics & Communication Engineering</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="geo">Geo Informatics Engineering</option>
                                    <option value="science">Science and Humanities</option>
                            </select>
                            </td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td><button class="btn btn-primary" type="submit" name="suballot">Send</button></td>
                            </tr>';
                        $number++;
                    }
                }
                ?>
            </tbody>
        </table>
    </form>
    <!--Course Table Ends-->
</body>

</html>
