<!-----AUTH SESSION STARTS-------------->
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "suball";

//create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


$email = $_SESSION['username'];
$sql = "SELECT username,department FROM users WHERE email='$email'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$name = $row['username'];
$udep = $row['department'];
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">

  <title>Home - Anna University Regional Campus-Tirunelveli</title>
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
          <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-hand-pointer-o" style="font-size:30px"></i>  Subject-Allocation <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link text-white" href="subject-list.php"><i class="fa fa-send" style="font-size:29px"></i> Send/Receive <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link text-white" href="listgeneration.php"><i class="fa fa-list" style="font-size:29px"></i>
            Subject-List <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>

    <!--PROFILE-->
      <li class="nav-item active">
          <i class="fa fa-user" style="font-size:29px"></i>&nbsp;
          <?php
            echo $name.' - ';
            if($udep == "Computer Science Engineering"){
              echo 'CSE';
            }
            else if($udep == "Electronics & Communication Engineering"){
              echo 'ECE';
            }
            else if($udep == "Mechanical Engineering"){
              echo 'MECH';
            }
            else if($udep == "Geo Informatics Engineering"){
              echo 'GEO';
            }
            else if($udep == "Science and Humanities"){
              echo 'Sci. & Humanities';
            }
           ?>&ensp;
          </li>

    <!-----------------LOGIN BUTTON-------------->
    <?php
    if (isset($_SESSION['username'])) {
      echo ' <li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Logout </a>
        </li>';
    } else {
      '<li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="login.php"><i class="fa fa-sign-in" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Login </a>
        </li>';
    }
    ?>



  </nav>
  <!-----------------NAV BAR ENDS---------------------->
  <!----------------TITLE TAG STARTS-------------------------->
  <center>
    <h1 style="color: #00008B; font-family: serif">Anna University Regional Campus-Tirunelveli</b></h1>
  </center>
  <center><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160"></center>

  <br>
  <p style="color: #000000; font-size: 120%; ">
    <marquee scrollamount="4"><b>"Scientists investigate that which already is; Engineers create that which has never been", "The way to succeed is to double your failure rate." - Albert Einstein</b></marquee>
  </p>

  <center>
    <!-----------------IMAGE SLIDES------------>
    <h3 style="color:blue"><b>DEPARTMENTS</b></h3>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="pics/cse.jpg" alt="CSE">
          <div class="carousel-caption">
            <h3>COMPUTER SCIENCE & ENGINEERING</h3>
          </div>
        </div>

        <div class="item">
          <img src="pics/ece.jpg" alt="ECE">
          <div class="carousel-caption">
            <h3>ELECTRONICS & COMMUNICATION ENGINEEERING</h3>
          </div>
        </div>

        <div class="item">
          <img src="pics/mech.jpg" alt="MECH">
          <div class="carousel-caption">
            <h3>MECHANICAL ENGINEERING</h3>
          </div>
        </div>

        <div class="item">
          <img src="pics/geo.jpg" alt="GEO">
          <div class="carousel-caption">
            <h2 class="text-black">GEO INFORMATICS ENGINEEERING</h2>
          </div>
        </div>

        <div class="item">
          <img src="pics/humanities.jpg" alt="Science">
          <div class="carousel-caption">
            <h3 class="text-white">SCIENCE & HUMANITIES</h3>
          </div>
        </div>
      </div>


      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </center><br>
  <!------------------IMAGE SLIDER ENDS------------------------------->

  <!------------------- SYLLABUS --------------------------------------->

  <center>
    <div class="container-fluid text-center">
      <h3 style="color:blue"><b>CURRICULUM & SYLLABI</b></h3> <br>
      <div class="row">
        <div class="card col-sm-2 col-sm-offset-1">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">CSE</a></h4>
            <p class="card-text">
              Department of Computer Science & Engineering<br>
              <b>Reg-2017</b><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2017_fu/01.B.E.%20CSE%20final.pdf" target="_blank">Download PDF Now</a>
            </p>
            <p class="card-text">
              <b>Reg-2021</b><br><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2021_fu/IandC/01.B.E.CSE.pdf" target="_blank">Download PDF Now</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">ECE</a></h4>
            <p class="card-text">
              Department of Electronics & Communication Engineering<br>
              <b>Reg-2017</b><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2017_fu/03.%20B.E.%20ECE%20final.pdf" target="_blank">Download PDF Now</a>
            </p>
            <p class="card-text">
              <b>Reg-2021</b><br><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2021_fu/IandC/06.B.E.ECE.pdf">Download PDF Now</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">MECHANICAL</a></h4>
            <p class="card-text">
              Department of Mechanical Engineering<br>
              <b>Reg-2017</b><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2017_fu/3.%20B.E.%20Mech%20.pdf">Download PDF Now</a>
            </p>
            <p class="card-text">
              <b>Reg-2021</b><br><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2021_fu/Mech/03.%20B.E.%20Mech..pdf" target="_blank">Download PDF Now</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">GEO INFORMATICS</a></h4>
            <p class="card-text">
              Department of Civil Engineering<br><br>
              <b>Reg-2017</b><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2017_fu/03.B.E.Geo.pdf" target="_blank">Download PDF Now</a>
            </p>
            <p class="card-text">
              <b>Reg-2021</b><br><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2021_fu/Civil/03.B.%20E.%20Geo.pdf" target="_blank">Download PDF Now</a>
            </p>
          </div>
        </div>

        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">CIVIL</a></h4>
            <p class="card-text">
              Department of Civil Engineering<br><br>
              <b>Reg-2017</b><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2017_fu/01.B.E.Civil.pdf" target="_blank">Download PDF Now</a>
            </p>
            <p class="card-text">
              <b>Reg-2021</b><br><br>
              <a href="https://cac.annauniv.edu/aidetails/afug_2021_fu/Civil/01.B.%20E.%20Civil.pdf" target="_blank">Download PDF Now</a>
            </p>
          </div>
        </div>

      </div>
    </div>
    <br>
  </center>

  <!--------------------FACULTY DETAILS------------------------------------->

  <center>

    <div class="container-fluid text-center">
      <h3 style="color:blue"><b>HEAD OF THE DEPARTMENTS</b></h3> <br>
      <div class="row">
        <div class="card col-sm-2 col-sm-offset-1">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">CSE</a></h4>
            <p class="card-text">
              <b>Dr.K.Saravanan</b><br>
              Assistant Professor & Head<br>
              Department of Computer Science & Engineering<br>
            <h5 class="text-uppercase text-blue"><b>Contact</b></h5><br>
            <a>saravanan.krishnan@auttvl.ac.in</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">ECE</a></h4>
            <p class="card-text">
              <b>Dr.S.Suja Priyadharsini</b><br>
              Assistant Professor & Head<br>
              Department of Electronics & Communication Engineering<br>
            <h5 class="text-uppercase text-blue"><b>Contact</b></h5><br>
            <a>sujapriyadarsini.s@auttvl.ac.in</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">MECHANICAL</a></h4>
            <p class="card-text">
              <b>Dr.K.Karuppasamy</b><br>
              Assistant Professor & Head<br>
              Department of Mechanical Engineering<br>
            <h5 class="text-uppercase text-blue"><b>Contact</b></h5><br>
            <a>kksamy1973@gmail.com</a>
            </p>
          </div>
        </div>
        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">GEO INFORMATICS</a></h4>
            <p class="card-text">
              <b>Dr.J.Thirumal</b><br>
              Assistant Professor & Head<br>
              Department of Civil Engineering<br><br>
            <h5 class="text-uppercase text-blue"><b>Contact</b></h5><br>
            <a>thirumal.j.@auttvl.ac.in</a>
            </p>
          </div>
        </div>

        <div class="card col-sm-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title"><a href="#" class="btn btn-primary btn-block">SCIENCE & HUMANITIES</a></h4>
            <p class="card-text">
              <b> Dr.M.Subramanian</b><br>
              Assistant Professor & Head<br>
              Department of Science & Humanities<br>
            <h5 class="text-uppercase text-blue"><b>Contact</b></h5><br>
            <a>subramanian.m@auttvl.ac.in</a>
            </p>
          </div>
        </div>

      </div>
    </div>
    <br>

  </center>
</body>

<!--------------FOOTER STARTS--------------------------------------->

<footer class="bg-dark text-white text-center text-lg-start">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h4 class="text-uppercase text-white">About Us</h4><br>

        <p style="font-size: 100%">
          Anna University, one of the excellent institutions of the southern part of
          India has its acquisitions to many institutions in Tamilnadu and one primary institution is the Anna University Regional Campus - Tirunelveli which extends high quality teaching ensuring contiguous progress of the young minds. Our campus has grown into an institution that provides excellent technical education in the field of Engineering and Management, within a short period. It offers excellent platform for the students to show off their talents and equip the students with confidence
          and high image profile to compete with the fast paced ambitious world.
        </p>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h4 class="text-uppercase text-white">Contact Us</h4><br>

        <p style="font-size: 100%">
          <i class="fa fa-home" style="font-size:20px"></i>
          Anna University Regional Campus - Tirunelveli<br>
          Tirunelveli,
          Tamilnadu
        </p>
        <p style="font-size: 100%">
          <i class="fa fa-exclamation-triangle" style="font-size:20px"></i>
          Pincode - 627007<br>
        </p>
        <p style="font-size: 100%">
          <i class="fa fa-phone" style="font-size:20px"></i>
          Phone: 0462-2551298<br>
        </p>
        <p style="font-size: 100%">
          <i class="fa fa-print" style="font-size:20px"></i>
          Fax: 0462-2552877
        </p>
      </div>

      <!--Grid column-->
      <div class="col-auto">
        <h4 class="text-uppercase">Links</h4><br>

        <ul class="list-styled mb-0">
          <li style="font-size: 110%">
            <a href="https://www.annauniv.edu/nwsnew/" class="text-cyan">Anna University,Chennai</a>
          </li>
          <li style="font-size: 110%">
            <a href="http://auttvl.ac.in" class="text-cyan">Regional Campus,Tirunelveli</a>
          </li>

        </ul>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>

  <!-- Copyright -->
  <div class="text-center bg-primary p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="http://auttvl.ac.in">Anna University Regional Campus-Tirunelveli.</a>
  </div>
  <!-- Copyright -->
</footer>

</html>