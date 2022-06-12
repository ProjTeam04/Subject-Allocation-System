<?php
//<!-----AUTH SESSION STARTS-------------->
//include auth_session.php file on all user panel pages
include("auth_session.php");
//<!-----AUTH SESSION ENDS-------------->

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
$email = $_SESSION['username'];
$query = "SELECT department from users where email = '$email'";
$re = mysqli_query($conn, $query);
$ro = mysqli_fetch_assoc($re);
$udep = $ro['department'];

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

                    $qry = "UPDATE subjects SET regulation = '$regulation', semester = '$semester', coursetitle='$coursetitle', category='$category', contactperiods='$contactperiods', lectures='$lectures', tutorials='$tutorials', practicals='$practicals', credits='$credits' WHERE coursecode='$coursecode' and department='$department'";
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
                        Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-hand-pointer-o" style="font-size:24px"></i> Subject-Allocation <span class="sr-only">(current)</span></a>
        </li>
        </ul>
        </div>
    </nav>
    <br><br>
    <div class="card w-25" style="width: 18rem; margin: 0 auto">
            <div class="card-body">
                <center>
                    <h3>Add new Subject</h3>   
                    <!--Popup Form for subjects-->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add Course</button>
                    <h3>View Subject details</h3>
                    <form action="displaysubject.php">
                        <button class="btn btn-primary">View</button>
                    </form>
                </center>
            </div>
        </div>
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
</body>

</html>
