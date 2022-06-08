<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
include("auth_session.php");
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Subject-Allocation</title>
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
    <!--Nav Starts-->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!---Home-->
             <ul class="navbar-nav me-auto order-0">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="home.php"><i class="fa fa-home" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link text-white" href="listgeneration.php"><i class="fa fa-list" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Subject-List</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link text-white" href="electivelist.php"><i class="fa fa-envelope" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Electives </a>
                </li>

            
                <!--- semester -->
                <li class="nav-item active">
                <form class="form-inline ml-2 ml-lg-0" method="post">
                    <input class="form-control mr-sm-2" type="text" name="year" value="" placeholder="Academic year" required="">

                    <select class="form-control" name="sem" required="">
                                
                                <option value="">Select semester</option>
                                <option value="odd">Odd</option>
                                <option value="even">Even</option>
                            </select>


                    <button class="btn btn-outline-success my-2 my-sm-0 btn-primary" type="submit" name="setyear">Set</button>
                </form>
                </li>
                <!--- semester ends-->
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
    <!--- semester backend-->
        <center>
            <div class="card w-25" style="width: 18rem; margin: 0 auto">
            <div class="card-body">
            <h3><b>Academic Year</b></h3>
            <?php  
                 if (isset($_POST['setyear'])){
                    $year = $_POST['year'];
                    $sem = $_POST['sem'];
                    $INSERT1 = "INSERT Into academicyear (year,sem) values(?,?)";
                    $stmt = $conn->prepare($INSERT1);
                    $stmt->bind_param("is", $year,$sem);
                    $stmt->execute();
                    header("Location: mailpage.php");
                    $stmt->close();
                 }
                 $yr="SELECT * from academicyear order by sno desc limit 1";
                 $qry_run = mysqli_query($conn, $yr);
                 $row = mysqli_fetch_assoc($qry_run);
                 echo '<h3><b>'.$row['year'].' - '.$row['sem'].' semester</b></h3>';
    ?></div></div></center>
    <br>
    <!--- semester selection end-->
    <!--- FILTER STARTS REGULATION DEPARTMENT---------------->
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
                                $res = mysqli_query($conn, $sql);
                                ?>
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
                                $sqry="SELECT * from academicyear order by sno desc limit 1";
                                $sem = mysqli_query($conn, $sqry);
                                $rowss = mysqli_fetch_assoc($sem);
                                $sql = "SELECT distinct semester from subjects";
                                $res = mysqli_query($conn, $sql); ?>
                                <option value="">select</option><?php
                                                                while ($rows = mysqli_fetch_array($res)) {
                                                                    if($rowss['sem'] == 'even' && $rows['semester']%2 == 0){
                                                                ?>
                                    <option value="<?php echo $rows['semester']; ?>"><?php echo $rows['semester']; ?></option>
                                <?php
                                    }
                                    else if($rowss['sem'] == 'odd' && $rows['semester']%2 != 0){
                                                                ?>
                                    <option value="<?php echo $rows['semester']; ?>"><?php echo $rows['semester']; ?></option>
                                <?php
                                    }
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
    <!-- filter ends -->
    <br>
    <form method="post">
        <table class="table table-bordered table-primary">
            <thead>
                <tr>
                    <th colspan="7"><center><h3><b>Theory</b></h3></center></th>
                </tr>
                <tr>
                    <th scope="col">SI.No</th>
                    <th scope="col">Regulation</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Department</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $email = $_SESSION['username'];
                $query = "SELECT department from users where email = '$email'";
                $re = mysqli_query($conn, $query);
                $ro = mysqli_fetch_assoc($re);
                $udep = $ro['department'];
                $sql = "SELECT * from subjects";
                $sqry="SELECT * from academicyear order by sno desc limit 1";
                $sem = mysqli_query($conn, $sqry);
                $rows = mysqli_fetch_assoc($sem);
                $yr = $rows['year'];
                $semes = $rows['sem'];
                //$rows1 = mysqli_fetch_assoc($res));
                if($rows['sem'] == 'even'){
                    $sql = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep' and lectures != 0 and practicals = 0 order by semester,regulation";
                    $sql1 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep' and lectures = 0 and practicals != 0 order by semester,regulation";
                }
                else if($rows['sem'] == 'odd'){
                    $sql = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                    $sql1 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                }
                $qy="SELECT * from electives where year='$yr' and sem='$semes' and department = '$udep' order by semester,regulation";
                $res = mysqli_query($conn, $qy);
                $result = mysqli_query($conn, $sql);
                $result1 = mysqli_query($conn, $sql1);
                $number = 1;
                if (isset($_GET['search'])) {
                    $filtervalues = $_GET['search'];
                    $sqry="SELECT * from academicyear order by sno desc limit 1";
                    $sem = mysqli_query($conn, $sqry);
                    $rows = mysqli_fetch_assoc($sem);
                    $yr = $rows['year'];
                    $semes = $rows['sem'];
                    
                    if($rows['sem'] == 'even'){
                        $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                        $qry1 = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                    }
                    else if($rows['sem'] == 'odd'){
                        $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                        $qry1 = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                    }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and department = '$udep' order by semester,regulation";
                    $qry_run = mysqli_query($conn, $qry);
                    $qry_run1 = mysqli_query($conn, $qry1);
                    $res = mysqli_query($conn, $qy);
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
                        $number++;
                    }
                    echo'<tr>
                    <th scope="row" colspan="7"><h3><center><b>Laboratory</b></center></h3></th>
                </tr>';
                    while ($row = mysqli_fetch_array($qry_run1)) {
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';

                            $number++;
                        }

                
                } 
                else if (isset($_POST['filtersubmit'])) {
                    $regulation = $_POST['regu'];
                    $semester = $_POST['semes'];
                    

                    $sqry="SELECT * from academicyear order by sno desc limit 1";
                    $sem = mysqli_query($conn, $sqry);
                    $rows = mysqli_fetch_assoc($sem);
                    $yr = $rows['year'];
                    $semes = $rows['sem'];
                    
                 if(!empty($regulation) && !empty($semester)){
                        $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                        $select1 = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                    // else if($rows['sem'] == 'odd'){
                    //     $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                    //     $select1 = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                    // }
                    $qy="SELECT * from electives where year='$yr' and sem='$semes' and regulation='$regulation' and semester='$semester' order by semester,regulation";
                }
                
                // else if(!empty($regulation)){
                //     if($rows['sem'] == 'even'){
                //         $select = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //         $select1 = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                //     }
                //     else if($rows['sem'] == 'odd'){
                //         $select = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //         $select1 = "SELECT * FROM subjects WHERE regulation='$regulation' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures = 0 and practicals != 0 order by semester,regulation";
                //     }
                //     $qy="SELECT * from electives where year='$yr' and sem='$semes' and regulation='$regulation' and department = '$udep' order by semester,regulation";
                // }
                
                // else if(!empty($semester)){
                //     if($rows['sem'] == 'even'){
                //         $select = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //          $select1 = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (2,4,6,8) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //     }
                //     else if($rows['sem'] == 'odd'){
                //         $select = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //         $select1 = "SELECT * FROM subjects WHERE semester='$semester' and category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and semester in (1,3,5,7) and department = '$udep'and lectures != 0 and practicals = 0 order by semester,regulation";
                //     }
                //     $qy="SELECT * from electives where year='$yr' and sem='$semes' and semester='$semester' and department = '$udep' order by semester,regulation";
                // }
                    $res = mysqli_query($conn, $qy);
                    $select = mysqli_query($conn, $select);
                    $select1 = mysqli_query($conn, $select1);

                        while ($row = mysqli_fetch_assoc($select)) {
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
                        $number++;
                    }
                    echo'<tr>
                    <th scope="row" colspan="7"><h3><center><b>Laboratory</b></center></h3></th>
                </tr>';
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
                            $number++;
                        }
                    
                } 
                 else if ($result && $result1 && $res) {
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
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
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
                        $number++;
                    }
                    echo'<tr>
                    <th scope="row" colspan="7"><h3><center><b>Laboratory</b></center></h3></th>
                </tr>';
                    while ($row = mysqli_fetch_assoc($result1)) {
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
    </form>
</body>
</html>