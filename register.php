<html>

<head>
   <title>Registration</title>
   <link rel="icon" href="annaunivlogo.webp">
   <link rel="icon" href="images/annaunivlogo.webp">
   <link rel="stylesheet" href="styleregistr.css">
</head>

<body>
   
   <div class="blur">
      <div class="center">
         <h1>
            <center>Register Here</center>
         </h1>

         <?php
         require('db.php');
         // When form submitted, insert values into the database.
         if (isset($_REQUEST['username'])) {
            // removes backslashes
            $username = stripslashes($_REQUEST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($con, $username);
            $email    = stripslashes($_REQUEST['email']);
            $email    = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $create_datetime = date("Y-m-d H:i:s");
            $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query);
            $duplicate = mysqli_query($conn, "select * from users where username='$user_name' or email='$email'");

            if ($result) {
               echo "<div class='form'>
               <center>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
               </center>
                  </div>";
            } else if ($duplicate) {
               echo "<div class='form'>
               <center>
                  <h3>Duplicate Email-ID!</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>Register</a> again</p>
               </center>
                  </div>";
            } else {
               "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
            }
         } else {
         ?>
            <form method="post">
               <center>
                  <div class="txt_field">
                     <input type="text" name="username" required="">
                     <span></span>
                     <label>Username</label>
                  </div>
                  <div class="txt_field">
                     <input type="email" name="email" required="">
                     <span></span>
                     <label>E-mail</label>
                  </div>

                  <div class="txt_field">
                     <input type="password" name="password" required="">
                     <span></span>
                     <label>Password</label>
                  </div>
                  <input type="submit" name="submit" value="Register">
                  <div class="signup_link">
                     Already have an account?
                     <a href="login.php">Signin</a>
                  </div>
               </center>
            </form>
         <?php
         }
         ?>





<<<<<<< HEAD
=======
<html>
<head>  
   <title>Registration</title>
   <link rel="icon" href="images/annaunivlogo.webp">
   <link rel="stylesheet" href="stylelogin.css">
</head>
<body> 
   <div class="blur">
   <div class="center">
      <h1><center>Register Here</center></h1>
         <form method="post"><center>
            <div class="txt_field">
               <input type="text" name="fname" required="">
               <span></span>
               <label>Firstname</label>
            </div>
            <div class="txt_field">
               <input type="text" name="lname" required="">
               <span></span>
               <label>Lastname</label>
            </div>
            <div class="txt_field">
               <input type="email" name="email" required="">
               <span></span>
               <label>E-mail</label>
            </div>
            <div class="txt_field">
               <input type="password" name="createpass" required="">
               <span ></span>
               <label>Create password</label>
            </div>
            <input type="submit" name="submit" value="Register"> 
>>>>>>> c9bb8a8314eed22859f680c779adc4843a807e8c

      </div>
   </div>
</body>

</html>