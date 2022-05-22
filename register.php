<?php
         require('db.php');
         // When form submitted, insert values into the database.
         if(isset($_POST['submit'])){
         if (isset($_REQUEST['username'])) {
            // removes backslashes
            $username = stripslashes($_REQUEST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($con, $username);
            $email    = stripslashes($_REQUEST['email']);
            $email    = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $department = stripslashes($_REQUEST['department']);
            $department = mysqli_real_escape_string($con, $department);
            $create_datetime = date("Y-m-d H:i:s");
            $query    = "INSERT into `users` (username, department, password, email, create_datetime)
                     VALUES ('$username', '$department','" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query);
            $duplicate = mysqli_query($con, "select * from users where username='$user_name' or email='$email' or department='$department'");

            if ($result) {
               ?><script>
                    alert("You are registered successfully.");
                </script>
               <?php
               header("Location: login.php");
            } else if ($duplicate) {
               echo "<div class='form'>
               <center>
                  <h3>Duplicate Email-ID or department!</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>Register</a> again</p>
               </center>
                  </div>";
            } else {
               "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
            }
         }
         } 
         ?>

<html>

<head>
   <title>Registration</title>
   <link rel="icon" href="annaunivlogo.webp">
   <link rel="stylesheet" href="styleregistr.css">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fetch.js"></script>
</head>

<body>
   
   <div class="blur">
      <div class="center">
         <h1>
            <center>Register Here</center>
         </h1>

         
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

                  <div class="dropdown">
                     <select class="form-control" name="department" id="dep" required="">
                                    <option id="dep">Department</option>
                                    <option id="dep" name="cse">Computer Science Engineering</option>
                                    <option id="dep" name="ece">Electronics & Communication Engineering</option>
                                    <option id="dep" name="mech">Mechanical Engineering</option>
                                    <option id="dep" name="geo">Geo Informatics Engineering</option>
                            </select>
                     <span></span>
                  </div><br>
                  <input type="submit" name="submit" value="Register">
                  <div class="signup_link">
                     Already have an account?
                     <a href="login.php">Signin</a>
                  </div>
               </center>
            </form>
      </div>
   </div>
</body>

</html>