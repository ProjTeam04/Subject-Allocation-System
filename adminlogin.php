<?php
include('db.php');
session_start();
if (isset($_POST['submit'])) {

$username = $_POST['user'];
$password = $_POST['pass'];

//to prevent from mysqli injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$sql = "select * from adminlogin where username = '$username' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
}
else{
    echo"<div class='form'><br><br>
               <center>
                  <h3>Incorrect Username/password</h3><br/>
                  </center>
                  </div>";
}
}
?>

<html>

<head>
    <title>PHP login system</title>
    <link rel="stylesheet" type="text/css" href="admincss.css">
</head>

<body>
    <br><br><br><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160">
    <div class="center">
        <h1>
            <center>Admin Login</center>
        </h1>
        <form name="f1" action="" onsubmit="return validation()" method="POST">
            <center>
                <div class="txt_field">
                    <input type="text" id="user" name="user" required="">
                    <label>Username</label>
                </div>
                <div class="txt_field">
                    <input type="password" id="pass" name="pass" required="">
                    <label>Password</label>
                </div>

                <input type="submit" name="submit" value="Login">

                <div class="signup_link">
                    <b> Are you a User? </b>
                    <a href="login.php">Login Here</a>
                </div>
            </center>
        </form>
    </div>


    <script>
        function validation() {
            var id = document.f1.user.value;
            var ps = document.f1.pass.value;
            if (id.length == "" && ps.length == "") {
                alert("User Name and Password fields are empty");
                return false;
            } else {
                if (id.length == "") {
                    alert("User Name is empty");
                    return false;
                }
                if (ps.length == "") {
                    alert("Password field is empty");
                    return false;
                }
            }
        }
    </script>
</body>

</html>