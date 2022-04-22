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
        $sno=$_GET['updateid'];
        if(isset($_POST['submit'])){
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

            if(!empty($semester) || !empty($department) ||  !empty($coursecode) || !empty($coursetitle) || !empty($category) || !empty($contactperiods) || !empty($lectures) || !empty($tutorials) || !empty($practicals) || !empty($credits)){

                $SELECT = "SELECT coursecode From subjects Where coursecode = ? Limit 1";
                $UPDATE ="update subjects set semester = $semester,department = '$department',coursecode = '$coursecode',coursetitle = '$coursetitle',category = '$category',contactperiods = $contactperiods,lectures = $lectures,tutorials = $tutorials,practicals = $practicals,credits = $credits";

                //prepare statement
                $stmt = $conn->prepare($SELECT);
                $stmt->bind_param("s", $coursecode);
                $stmt->execute();
                $stmt->bind_result($coursecode);
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if ($rnum==0){
                    $stmt=$conn->prepare($UPDATE);
                    $stmt->bind_param("issssiiiii", $semester,$department,$coursecode,$coursetitle,$category,$contactperiods,$lectures,$tutorials,$practicals,$credits);
                    $stmt->execute();
                    header('location:subject1.php');
                }
                else{
                    echo "Course is already exist!";
                }
                $stmt->close();
                $conn->close();
            }
            else {
                echo "All field are required";
                die();
                }
        }
    }
?>


