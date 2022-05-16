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
  <title>Anna University Regional Campus-Tirunelveli</title>
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
          <a class="nav-link text-white" href="subject-list.php"><i class="fa fa-list" style="font-size:29px"></i>
            Subject-List <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-pencil" style="font-size:30px"></i>Elective-Allocation<span class="sr-only">(current)</span></a>
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
    <center>
      <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>Welcome</p>
      </div>
    </center>
    <div class="col">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-50" src="backgrnd.jpg" alt="First slide">
          </div><br>
          <div class="carousel-item">
            <img class="d-block w-50" src="annaunivlogo.webp" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-50" src="backgrnd.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </center>

</body>

<footer>

</footer>

</html>