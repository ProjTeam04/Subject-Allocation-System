<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname= "suball";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if(isset($_POST['submit'])){
if(mysqli_connect_error()){
   die('Connect Error ('. mysqli_connect_errno() .') '
         . mysqli_connect_error());
}
else{
   $fname = $_POST['fname'];  
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $createpass = $_POST['createpass'];
   $username=$_POST['email'];
   $password=$_POST['createpass'];
   if(!empty($fname) || !empty($lname) || !empty($email) ||!empty($createpass)){
      $SELECT = "SELECT email From login1 Where email = ? Limit 1";
       //  $INSERT2 = "INSERT Into 'sample' (fname, lname, email, createpass ) values(?,?,?,?)";
       //  $INSERT2 = "INSERT Into 'sample' SET fname= :fname, lname = :lname, email=:email, createpass=:createpass";
         $INSERT1 ="INSERT Into login1 (fname,lname,email,createpass) values(?,?,?,?)";

       //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
    $stmt->execute();
     $stmt->bind_result($email);
    $stmt->store_result();
     $rnum = $stmt->num_rows;



     //checking username
     if ($rnum==0) {
      //$stmt->close();
      //$stmt = $conn->prepare($INSERT2);
      $stmt=$conn->prepare($INSERT1);
      $stmt->bind_param("ssss", $fname,$lname,$email,$createpass);
      //$stmt->bind_param("ss",$username,$password);
      $stmt->execute();
      header("Location: login.php");
       //echo "New record inserted sucessfully";

     } 
     else {
      echo "Someone already register using this email";
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



<html>
<head>  
   <title>Registration</title>
<<<<<<< HEAD
   <link rel="icon" href="annaunivlogo.webp">
=======
   <link rel="icon" href="images/annaunivlogo.webp">
>>>>>>> 7466f07e252c1f5dfdf6952ae501c303018d97ba
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

         </center></form>
   </div>
</div>
</body>
</html>