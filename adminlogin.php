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
        <form name="f1" action="authentication.php" onsubmit="return validation()" method="POST">
            <center>
                <div class="txt_field">
                    <input type="text" id="user" name="user" required="">
                    <label>Username</label>
                </div>
                <div class="txt_field">
                    <input type="password" id="pass" name="pass" required="">
                    <label>Password</label>
                </div>
                <div class="signup_link">
                    <b> Are you a User? </b>
                    <a href="login.php">Login Here</a>
                </div>
                <input type="submit" name="submit" value="Login">

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