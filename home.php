<!-----AUTH SESSION STARTS-------------->
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">
  <title>AURCT</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!---Home-->
      <ul class="navbar-nav me-auto order-0">
        <li class="nav-item active">
          <a class="nav-link text-white" href="home.php"><i class="fa fa-home" style="font-size:29px"></i><span class="sr-only">(current)</span> Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link text-white" href="subject1.php">
            <i class="fa fa-pencil" style="font-size:30px" aria-hidden="true"></i>Subject-Entry <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-pencil" style="font-size:30px"></i>Elective-Allocation<span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link text-white" href="subject-list.php"><i class="fa fa-list" style="font-size:29px"></i>
            Subject-List <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    <!-----------------LOGIN BUTTON-------------->
    <?php
    if(isset($_SESSION['username'])){
    echo ' <li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Logout </a>
        </li>';
    }else{ '<li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="login.php"><i class="fa fa-sign-in" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Login </a>
        </li>';
    }
    ?>



  </nav>
  <!-----------------NAV BAR ENDS---------------------->

  <center><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160"></center>
  <br><br>
 
    <center>
      <figure class="text-center">
          <blockquote class="blockquote">
            <marquee behavior="scroll" direction="left" scrollamound="50"><h3><p>The purpose of education is to make good human beings with skill and expertise... Enlightened human beings can be created by teachers.</p></h3></marquee>
          </blockquote><h4>
          <figcaption class="blockquote-footer">
            <cite title="Source Title">A.P.J. Abdul Kalam</cite>
          </figcaption></h4>
        </figure>
      <div class="form">
        <?php
        require('db.php');
        $email = $_SESSION['username'];
        $sql ="SELECT username from users where email='$email'";
        $res = mysqli_query($con, $sql);
        $rows = mysqli_fetch_array($res);
        ?>
        <h3>Welcome, <?php echo $rows['username']; ?> !</h3>
      </div>
    </center>

</body>

</html>