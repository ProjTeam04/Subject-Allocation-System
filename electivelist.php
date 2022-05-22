<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (isset($_POST['sendmail'])) {
    if (isset($_POST['subjects'])) {
        $subjects = $_POST['subjects'];
        foreach ($subjects as $key => $value) {
            $query = "SELECT * from subjects Where coursecode = '$value'";
            $query1="SELECT * from academicyear order by sno desc limit 1";
            $qry_run = mysqli_query($conn, $query);
            $qry_run1 = mysqli_query($conn, $query1);
            $row = mysqli_fetch_assoc($qry_run);
            $row1 = mysqli_fetch_assoc($qry_run1);
            $yr = $row1['year'];
            $sem = $row1['sem'];
            $regulation = $row['regulation'];
            $semester = $row['semester'];
            $department = $row['department'];
            $coursecode = $row['coursecode'];
            $coursetitle = $row['coursetitle'];
            $category = $row['category'];
            $INSERT1 = "INSERT Into electives (year,sem,regulation,semester,department,coursecode,coursetitle,category) values(?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($INSERT1);
            $stmt->bind_param("isiissss", $yr, $sem, $regulation, $semester, $department, $coursecode, $coursetitle, $category);
            $stmt->execute();
            header("Location: electivelist.php");
            $stmt->close();
        }
    } else {
        echo "you should select atleast one subject";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Elective List</title>
    <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
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
                    <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-arrow-left" style="font-size:24px"></i>
                        Back<span class="sr-only">(current)</span></a>
                </li>

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
    <!--- FILTER STARTS REGULATION DEPARTMENT---------------->
    <form method="post">
        <center>
            <div class="btn-group btn-group-inline">
                <div class="container">
                    <div class="row">
                        <div class="col order-first">
                            <label>Regulation</label><br>
                            <select class="form-control" name="regu" id="reg">
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
                        <div class="col">
                            <label>Department</label>
                            <select class="form-control" name="dept" id="dep">
                                <?php
                                $sql = "SELECT distinct department from subjects";
                                $res = mysqli_query($conn, $sql); ?>
                                <option value="">select</option><?php
                                                                while ($rows = mysqli_fetch_array($res)) {
                                                                ?>
                                    <option value="<?php echo $rows['department']; ?>"><?php echo $rows['department']; ?></option>
                                <?php
                                                                }
                                ?>
                            </select>
                            <span></span>
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
                        <button class="btn btn-outline-success my-2 my-sm-0 btn-primary" type="submit" name="filtersubmit">Search</button>
                    </div>
                </div>
        </center>
    </form>
    <!-- filter ends -->
    <br>
    <form method="post">
        <center>
            <button type="submit" class="btn btn-primary btn-lg" name="sendmail">Add</button>
            <input class="btn btn-danger btn-lg" type="reset" value="Cancel">
        </center><br>
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
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * from subjects where category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                $result = mysqli_query($conn, $sql);
                $number = 1;
                if (isset($_GET['search'])) {
                    $filtervalues = $_GET['search'];
                    $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') ";
                    $qry_run = mysqli_query($conn, $qry);

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
                            <td><input type="checkbox" class="form-check-input" value="' . $cc . '" name="subjects[]"></td>
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
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
                    $department = $_POST['dept'];
                    $semester = $_POST['semes'];

                    if(!empty($regulation) && !empty($department) && !empty($semester)){
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and department='$department' and semester='$semester' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($regulation) && !empty($department)){
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and department='$department' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($regulation) && !empty($semester)){
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($semester) && !empty($department)){
                    $select = "SELECT * FROM subjects WHERE department='$department' and semester='$semester' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($regulation)){
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($department)){
                    $select = "SELECT * FROM subjects WHERE department='$department' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                else if(!empty($semester)){
                    $select = "SELECT * FROM subjects WHERE semester='$semester' and category in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5')";
                }
                    $select1 = mysqli_query($conn, $select);

                    if (mysqli_num_rows($select1) > 0) {
                        while ($row = mysqli_fetch_assoc($select1)){
                            $sno = $row['sno'];
                            $reg = $row['regulation'];
                            $sem = $row['semester'];
                            $dep = $row['department'];
                            $cc = $row['coursecode'];
                            $ct = $row['coursetitle'];
                            $cat = $row['category'];
                            echo '<tr>
                            <td><input type="checkbox" class="form-check-input" value="' . $cc . '" name="subjects[]"></td>
                            <td>' . $number . '</td>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            </tr>';
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
                            <td><input type="checkbox" class="form-check-input" value="' . $cc . '" name="subjects[]"></td>
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