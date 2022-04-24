
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
        if(isset($_POST['submit'])){
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

            if(!empty($regulation) || !empty($semester) || !empty($department) ||  !empty($coursecode) || !empty($coursetitle) || !empty($category) || !empty($contactperiods) || !empty($lectures) || !empty($tutorials) || !empty($practicals) || !empty($credits)){

                $SELECT = "SELECT coursecode From subjects Where coursecode = ? Limit 1";
                $INSERT1 ="INSERT Into subjects (regulation,semester,department,coursecode,coursetitle,category,contactperiods,lectures,tutorials,practicals,credits) values(?,?,?,?,?,?,?,?,?,?,?)";

                //prepare statement
                $stmt = $conn->prepare($SELECT);
                $stmt->bind_param("s", $coursecode);
                $stmt->execute();
                $stmt->bind_result($coursecode);
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if ($rnum==0){
                    $stmt=$conn->prepare($INSERT1);
                    $stmt->bind_param("iissssiiiii",$regulation,$semester,$department,$coursecode,$coursetitle,$category,$contactperiods,$lectures,$tutorials,$practicals,$credits);
                    $stmt->execute();
                    header("Location: subject1.php");
                }
                else{
                    echo "Course is already exist!";
                }
                $stmt->close();
            }
            else {
                echo "All field are required";
                die();
                }
        }

        if(isset($_POST['updatesubmit'])){
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

            if($result){
                header("Location:subject1.php");
            }
            else{
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
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
                        <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                <!---Regulation-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Regulation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">2013</a>
                            <a class="dropdown-item" href="#">2017</a>
                            <a class="dropdown-item" href="#">2021</a>
                        </div>
                    </li>
                <!---Department-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Department
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Computer Science Engineering</a>
                            <a class="dropdown-item" href="#">Electronics & Communication Engineering</a>
                            <a class="dropdown-item" href="#">Mechanical Engineering</a>
                            <a class="dropdown-item" href="#">Geo Informatics Engineering</a>
                            <a class="dropdown-item" href="#">Civil Engineering</a>
                            <a class="dropdown-item" href="#">Science and Humanities</a>
                        </div>
                    </li>
                <!---Semester-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Semester
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Odd Semesters</a>
                            <a class="dropdown-item" href="#">Even Semesters</a>
                        </div>
                    </li>
                <!--Popup Form-->
                    <li  class="nav-item button">
                        <button type="button" class="btn btn-close-white" data-toggle="modal" data-target="#myModal">Add Course</button>
                        <!-- popup starts-->
                        <div id="myModal" class="modal fade bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                        
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title" style="margin: 0 auto"><b>Add Course Details</b></h1>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!--copy-->
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
                                                                <input type="number" class="form-control" name="semester" required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <input type="text" class="form-control" name="department" required="">
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
                                                                <input type="number" class="form-control" name="contactperiods"  required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Lectures</label>
                                                                <input type="number" class="form-control" name="lectures" required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tutorials</label>
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
                                        <!---copy ends-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- popup ends-->
                        </li>
                    </ul>
                <!--Search Bar-->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-dark" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <!--Nav Ends-->
        <!--Course Table Starts-->
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
                    $sql="SELECT * from subjects";
                    $result=mysqli_query($conn,$sql);
                    $number=1;
                    if(isset($_GET['search'])){
                        $filtervalues = $_GET['search'];
                        $qry = "SELECT * FROM subjects WHERE CONCAT(coursetitle,coursecode) LIKE '%$filtervalues%' ";
                        $qry_run = mysqli_query($conn,$qry);

                        if(mysqli_num_rows($qry_run) > 0){
                            while($row=mysqli_fetch_assoc($qry_run)){
                            $sno=$row['sno'];
                            $reg=$row['regulation'];
                            $sem=$row['semester'];
                            $dep=$row['department'];
                            $cc=$row['coursecode'];
                            $ct=$row['coursetitle'];
                            $cat=$row['category'];
                            $cp=$row['contactperiods'];
                            $lec=$row['lectures'];
                            $tut=$row['tutorials'];
                            $prac=$row['practicals'];
                            $cred=$row['credits'];
                            echo'<tr>
                            <th scope="row">'.$sno.'</th>
                            <td>'.$reg.'</td>
                            <td>'.$sem.'</td>
                            <td>'.$dep.'</td>
                            <td>'.$cc.'</td>
                            <td>'.$ct.'</td>
                            <td>'.$cat.'</td>
                            <td>'.$cp.'</td>
                            <td>'.$lec.'</td>
                            <td>'.$tut.'</td>
                            <td>'.$prac.'</td>
                            <td>'.$cred.'</td>
                            <td><button type="button" class="btn btn-primary editbutton">Update</button>
                                    
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid='.$sno.'" class="text-light">Delete</a></button>
                            </td>
                            </tr>';
                            }
                        }
                        else{
                            ?>
                                <tr>
                                    <td colspan="13">No record found</td>
                                </tr>
                            <?php
                        }
                    }
                    else if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $sno=$row['sno'];
                            $reg=$row['regulation'];
                            $sem=$row['semester'];
                            $dep=$row['department'];
                            $cc=$row['coursecode'];
                            $ct=$row['coursetitle'];
                            $cat=$row['category'];
                            $cp=$row['contactperiods'];
                            $lec=$row['lectures'];
                            $tut=$row['tutorials'];
                            $prac=$row['practicals'];
                            $cred=$row['credits'];
                            echo'<tr>
                            <th scope="row">'.$number.'</th>
                            <td>'.$reg.'</td>
                            <td>'.$sem.'</td>
                            <td>'.$dep.'</td>
                            <td>'.$cc.'</td>
                            <td>'.$ct.'</td>
                            <td>'.$cat.'</td>
                            <td>'.$cp.'</td>
                            <td>'.$lec.'</td>
                            <td>'.$tut.'</td>
                            <td>'.$prac.'</td>
                            <td>'.$cred.'</td>
                            <td><button type="button" class="btn btn-primary editbutton">Update</button>                        
                            
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid='.$sno.'" class="text-light">Delete</a></button>
                            </td>
                            </tr>';
                            $number++;
                        }
                    }
                    ?>
                    <div id="myeditmodel" class="modal fade bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                                <input type="number" class="form-control" name="regulation" id="reg" required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Semester</label>
                                                                <input type="number" class="form-control" name="semester" id="sem" required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <input type="text" class="form-control" name="department" id="dep" required="">
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
                                                                <input type="number" class="form-control" name="contactperiods" id="cp"  required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Lectures</label>
                                                                <input type="number" class="form-control" name="lectures" id="lec" required="">
                                                                <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tutorials</label>
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

$(document).ready(function(){
    $('.editbutton').on('click',function(){
        $('#myeditmodel').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);

            $('#reg').val(data[0]);
            $('#sem').val(data[1]);
            $('#dep').val(data[2]);
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