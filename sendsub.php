<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname= "suball";

    //create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (isset($_POST['suballot']) || isset($_GET['subid'])) {
            $todepartment=$_POST['todepartment'];
            $subid = $_GET['subid'];
            $stat = 'sent';
            $query = "SELECT * from subjects Where sno = '$subid'";
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
            $coursecode = $row['coursecode'];
            $coursetitle = $row['coursetitle'];
            $category = $row['category'];
            $status = $stat;
            $INSERT1 = "INSERT Into depwisepaper (acyear,sem,regulation,semester,fromdepartment,todepartment,coursecode,coursetitle,category,status) values(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($INSERT1);
            $stmt->bind_param("isiissssss",$yr, $sem, $regulation, $semester, $fromdepartment, $todepartment, $coursecode, $coursetitle, $category,$status);
            $stmt->execute();
            $stmt->close();
            header('location:subject-list.php');

        }
        if(isset($_POST['sendsub'])){
        $subjects = $_POST['subjects'];
        foreach ($subjects as $key => $value) {
            $sno = $value;
            $stat = 'Accepted';
            $qe = "UPDATE depwisepaper SET status = '$stat' WHERE sno='$sno'";
            $re = mysqli_query($conn, $qe);
        }

        header('Location:subject-list.php');
}
    ?>