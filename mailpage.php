<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname= "suball";

    //create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    if(isset($_POST['sendmail'])){
        if(isset($_POST['subjects'])){
            $subjects = $_POST['subjects'];
            echo "you selected the following subjects:<br>";
            foreach ($subjects as $key => $value) {
                $query = "SELECT regulation, semester, department, coursetitle from subjects Where coursecode = '$value'";
                $qry_run = mysqli_query($conn,$query);
                $row=mysqli_fetch_assoc($qry_run);
                echo $value.'-'.$row['regulation'];
                echo "<br>";

            }
        }
        else{
            echo "you should select atleast one subject";
        }
    }
?>

<!DOCTYPE html>
 <html>
     <head>
        <title>Send-Mail</title>
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
                </ul>
            </div>
                <!--Search Bar-->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-dark" type="submit">Search</button>
                </form>
        </nav>
        <form method="post">
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
                            echo'<tr>
                            <td><input type="checkbox" class="form-check-input" value="'.$cc.'" name="subjects[]"></td>
                            <td>'.$sno.'</td>
                            <td>'.$reg.'</td>
                            <td>'.$sem.'</td>
                            <td>'.$dep.'</td>
                            <td>'.$cc.'</td>
                            <td>'.$ct.'</td>
                            <td>'.$cat.'</td>
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
                            echo'<tr>
                            <td><input type="checkbox" class="form-check-input" value="'.$cc.'" name="subjects[]"></td>
                            <td>'.$number.'</td>
                            <td>'.$reg.'</td>
                            <td>'.$sem.'</td>
                            <td>'.$dep.'</td>
                            <td>'.$cc.'</td>
                            <td>'.$ct.'</td>
                            <td>'.$cat.'</td>
                            </tr>';
                            $number++;
                        }
                    }
                    ?>
            </tbody>
        </table>
        <center>
            <button type="submit" class="btn btn-primary btn-lg" name="sendmail">Send</button>
            <input class="btn btn-danger btn-lg" type="reset" value="Cancel">
        </center>
    </form>
    </body>
</html>