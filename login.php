 <html>

 <head>
    <title>Login</title>
    <link rel="icon" href="annaunivlogo.webp">
    <link rel="stylesheet" href="stylelogin.css">
 </head>

 <body>
    <br><br><br><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160">
    <div class="center">
       <h1>
          <center>Welcome! Login Here</center>
       </h1>

       <?php
         require('db.php');
         session_start();
         if (isset($_POST['username'])) {

            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            
            // Check user is exist in the database
            $query    = "SELECT * FROM `users` WHERE email='$username' AND password='" . md5($password) . "'";
            $result = mysqli_query($con, $query) or die(mysqli_error());
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
               $_SESSION['username'] = $username;
               // Redirect to user dashboard page
               header("Location: home.php");
            } else {
               echo
               "<div class='form'>
               <center>
                  <h3>Incorrect Username/password</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again</p>
                  </center>
                  </div>";
            }
         } else {
         ?>
          <form method="post">
             <center>
                <div class="txt_field">
                   <input type="text" name="username" required="">
                   <label>Username</label>
                </div>
                <div class="txt_field">
                   <input type="password" name="password" required="">
                   <label>Password</label>
                </div>
                <div class="pass">Forgot Password?</div>
                <input type="submit" name="submit" value="Login">
                <div class="signup_link">
                   Don't have an account?
                   <a href="register.php">Signup</a>
                </div>
             </center>
          </form>
    </div>
 <?php
   }
   ?>
 </body>
 </html>