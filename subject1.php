<!-----AUTH SESSION STARTS-------------->
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!-----AUTH SESSION ENDS-------------->

<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
} else {
    if (isset($_POST['submit'])) {
        $regulation = $_POST['regulation'];
        $semester = $_POST['semester'];
        $department = $_POST['department'];
        $coursecode = $_POST['coursecode'];
        $coursetitle = $_POST['coursetitle'];
        $category = $_POST['category'];
        $contactperiods = $_POST['contactperiods'];
        $lectures = $_POST['lectures'];
        $tutorials = $_POST['tutorials'];
        $practicals = $_POST['practicals'];
        $credits = $_POST['credits'];

        if (!empty($regulation) || !empty($semester) || !empty($department) ||  !empty($coursecode) || !empty($coursetitle) || !empty($category) || !empty($contactperiods) || !empty($lectures) || !empty($tutorials) || !empty($practicals) || !empty($credits)) {


            $INSERT1 = "INSERT Into subjects (regulation,semester,department,coursecode,coursetitle,category,contactperiods,lectures,tutorials,practicals,credits) values(?,?,?,?,?,?,?,?,?,?,?)";
            $SELECT = "SELECT * from subjects where department='$department' and coursecode='$coursecode'";
            $select1 = mysqli_query($conn, $SELECT);

            if (mysqli_num_rows($select1) > 0) {
        ?><script>
                    alert("course is already exist!");
                </script><?php
                        } else {
                            $stmt = $conn->prepare($INSERT1);
                            $stmt->bind_param("iissssiiiii", $regulation, $semester, $department, $coursecode, $coursetitle, $category, $contactperiods, $lectures, $tutorials, $practicals, $credits);
                            $stmt->execute();
                            header("Location: subject1.php");
                        }
                        $stmt->close();
                    } else {
                        echo "All field are required";
                        die();
                    }
                }

                if (isset($_POST['updatesubmit'])) {
                    $regulation = $_POST['regulation'];
                    $semester = $_POST['semester'];
                    $department = $_POST['department'];
                    $coursecode = $_POST['coursecode'];
                    $coursetitle = $_POST['coursetitle'];
                    $category = $_POST['category'];
                    $contactperiods = $_POST['contactperiods'];
                    $lectures = $_POST['lectures'];
                    $tutorials = $_POST['tutorials'];
                    $practicals = $_POST['practicals'];
                    $credits = $_POST['credits'];

                    $qry = "UPDATE subjects SET regulation = '$regulation', semester = '$semester', department='$department', coursetitle='$coursetitle', category='$category', contactperiods='$contactperiods', lectures='$lectures', tutorials='$tutorials', practicals='$practicals', credits='$credits' WHERE coursecode='$coursecode'";
                    $result = mysqli_query($conn, $qry);

                    if ($result) {
                        header("Location:subject1.php");
                    } else {
                        echo 'Data not updated!';
                    }
                }
            }
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Subject-Entry</title>
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
                    <a class="nav-link text-white" href="home.php"><i class="fa fa-home" style="font-size:24px"></i><span class="sr-only">(current)</span>
                        Home</a>
                </li>

                <!--Popup Form for subjects-->
                <li class="nav-item button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Course</button>
                    <!-- popup starts-->
                    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" style="margin: 0 auto"><b>Add Course Details</b></h1>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Regulation</label>
                                                            <input type="number" class="form-control" name="regulation" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Semester</label>
                                                            <select class="form-control" name="semester" id="sem" required="">
                                                                <option id="sem" name="odd1">1</option>
                                                                <option id="sem" name="even1">2</option>
                                                                <option id="sem" name="odd2">3</option>
                                                                <option id="sem" name="even2">4</option>
                                                                <option id="sem" name="odd3">5</option>
                                                                <option id="sem" name="even3">6</option>
                                                                <option id="sem" name="odd4">7</option>
                                                                <option id="sem" name="even4">8</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select class="form-control" name="department" id="dep" required="">
                                                                <option id="dep" name="cse">Computer Science Engineering</option>
                                                                <option id="dep" name="ece">Electronics & Communication Engineering</option>
                                                                <option id="dep" name="mech">Mechanical Engineering</option>
                                                                <option id="dep" name="geo">Geo Informatics Engineering</option>
                                                                <option id="dep" name="civil">Civil Engineering</option>
                                                                <option id="dep" name="humanities">Science and Humanities</option>
                                                            </select>
                                                            <span></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Course code</label>
                                                            <input type="text" class="form-control" name="coursecode" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Course title</label>
                                                            <input type="text" class="form-control" name="coursetitle" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <input type="text" class="form-control" name="category" required="">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                    <div class="col">

                                                        <div class="form-group">
                                                            <label>Contact Periods</label>
                                                            <input type="number" class="form-control" name="contactperiods" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Lectures</label>
                                                            <input type="number" class="form-control" name="lectures" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Theory</label>
                                                            <input type="number" class="form-control" name="tutorials" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Practicals</label>
                                                            <input type="number" class="form-control" name="practicals" required="">
                                                            <span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Credits</label>
                                                            <input type="number" class="form-control" name="credits" required="">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
                        <button class="btn btn-outline-success my-2 my-sm-0 btn-primary" type="submit" name="filtersubmit">Submit</button>

                    </div>
                </div>
        </center>
    </form>
    <!--Course Table Starts-->
    <br>
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
                <th scope="col">Contact Periods</th>
                <th scope="col">L</th>
                <th scope="col">T</th>
                <th scope="col">P</th>
                <th scope="col">C</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * from subjects";
            $result = mysqli_query($conn, $sql);
            $number = 1;
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode,category) LIKE '%$filtervalues%' ";
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
                        $cp = $row['contactperiods'];
                        $lec = $row['lectures'];
                        $tut = $row['tutorials'];
                        $prac = $row['practicals'];
                        $cred = $row['credits'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td>' . $cp . '</td>
                            <td>' . $lec . '</td>
                            <td>' . $tut . '</td>
                            <td>' . $prac . '</td>
                            <td>' . $cred . '</td>
                            <td><button type="button" class="btn btn-primary editbutton">Update</button>
                                    
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $sno . '" class="text-light">Delete</a></button>
                            </td>
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
                $department = $_POST['dept'];
                $semester = $_POST['semes'];
                if (!empty($regulation) && !empty($department) && !empty($semester)) {
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and department='$department' and semester='$semester'";
                } else if (!empty($regulation) && !empty($department)) {
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and department='$department'";
                } else if (!empty($regulation) && !empty($semester)) {
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation' and semester='$semester'";
                } else if (!empty($semester) && !empty($department)) {
                    $select = "SELECT * FROM subjects WHERE department='$department' and semester='$semester'";
                } else if (!empty($regulation)) {
                    $select = "SELECT * FROM subjects WHERE regulation='$regulation'";
                } else if (!empty($department)) {
                    $select = "SELECT * FROM subjects WHERE department='$department'";
                } else if (!empty($semester)) {
                    $select = "SELECT * FROM subjects WHERE semester='$semester'";
                }
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
                        $cp = $row['contactperiods'];
                        $lec = $row['lectures'];
                        $tut = $row['tutorials'];
                        $prac = $row['practicals'];
                        $cred = $row['credits'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td>' . $cp . '</td>
                            <td>' . $lec . '</td>
                            <td>' . $tut . '</td>
                            <td>' . $prac . '</td>
                            <td>' . $cred . '</td>
                            <td><button type="button" class="btn btn-primary editbutton">Update</button>
                                    
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $sno . '" class="text-light">Delete</a></button>
                            </td>
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
                    $cp = $row['contactperiods'];
                    $lec = $row['lectures'];
                    $tut = $row['tutorials'];
                    $prac = $row['practicals'];
                    $cred = $row['credits'];
                    echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $reg . '</td>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td>' . $cat . '</td>
                            <td>' . $cp . '</td>
                            <td>' . $lec . '</td>
                            <td>' . $tut . '</td>
                            <td>' . $prac . '</td>
                            <td>' . $cred . '</td>
                            <td><button type="button" class="btn btn-primary editbutton">Update</button>                        
                            
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $sno . '" class="text-light">Delete</a></button>
                            </td>
                            </tr>';
                    $number++;
                }
            }
            ?>
            <div id="myeditmodel" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" style="margin: 0 auto"><b>Edit Course Details</b></h1>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Regulation</label>
                                                    <input type="number" class="form-control" name="regulation" id="regu" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label>
                                                    <select class="form-control" name="semester" id="semes" required="">
                                                        <option id="sem" name="odd1">1</option>
                                                        <option id="sem" name="even1">2</option>
                                                        <option id="sem" name="odd2">3</option>
                                                        <option id="sem" name="even2">4</option>
                                                        <option id="sem" name="odd3">5</option>
                                                        <option id="sem" name="even3">6</option>
                                                        <option id="sem" name="odd4">7</option>
                                                        <option id="sem" name="even4">8</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control" name="department" id="depet" required="">
                                                        <option id="dep" name="cse">Computer Science Engineering</option>
                                                        <option id="dep" name="ece">Electronics & Communication Engineering</option>
                                                        <option id="dep" name="mech">Mechanical Engineering</option>
                                                        <option id="dep" name="geo">Geo Informatics Engineering</option>
                                                        <option id="dep" name="civil">Civil Engineering</option>
                                                        <option id="dep" name="humanities">Science and Humanities</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Course code</label>
                                                    <input type="text" class="form-control" name="coursecode" id="cc" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Course title</label>
                                                    <input type="text" class="form-control" name="coursetitle" id="ct" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <input type="text" class="form-control" name="category" id="cat" required="">
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact Periods</label>
                                                    <input type="number" class="form-control" name="contactperiods" id="cp" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Lectures</label>
                                                    <input type="number" class="form-control" name="lectures" id="lec" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Theory</label>
                                                    <input type="number" class="form-control" name="tutorials" id="tut" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Practicals</label>
                                                    <input type="number" class="form-control" name="practicals" id="prac" required="">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Credits</label>
                                                    <input type="number" class="form-control" name="credits" id="cred" required="">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="updatesubmit">Update</button>
                                            <input class="btn btn-danger" type="reset" value="Clear">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tbody>
    </table>
    <!--Course Table Ends-->
</body>

</html>
<script>
    $(document).ready(function() {
        $('.editbutton').on('click', function() {
            $('#myeditmodel').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#regu').val(data[0]);
            $('#semes').val(data[1]);
            $('#depet').val(data[2]);
            $('#cc').val(data[3]);
            $('#ct').val(data[4]);
            $('#cat').val(data[5]);
            $('#cp').val(data[6]);
            $('#lec').val(data[7]);
            $('#tut').val(data[8]);
            $('#prac').val(data[9]);
            $('#cred').val(data[10]);
        });
    });
</script>