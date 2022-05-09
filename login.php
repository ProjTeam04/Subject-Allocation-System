      <?php
      $conn = new mysqli("localhost", "root", "", "suball");

      if (isset($_POST['submit'])) {
         $username = $_POST['username'];
         $password = $_POST['password'];
         if (!empty($username) || !empty($password)) {
            $username = stripcslashes($username);
            $password = stripcslashes($password);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);


            //mysqli_connect("project");


            $result = mysqli_query($conn, "select * from login1 where email = '$username' and createpass = '$password'")
               or die("Failed to query database " . mysqli_error());
            $row = mysqli_fetch_array($result);
            if (isset($_POST['username']) && isset($_POST['password'])) {
               if ($row['email'] == $username && $row['createpass'] == $password) {
                  /*echo "Login success!!! Welcome ".$row['email'];*/
                  header("Location: home.html");
                  die();
               } else {
                  echo "Invalid credentials!!";
                  die();
               }
            }
         }
      }
      ?>

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
      </body>
</html>