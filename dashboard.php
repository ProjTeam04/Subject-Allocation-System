<!-----AUTH SESSION STARTS-------------->
<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fetch.js"></script>
</head>

<body>

    <!--Nav Starts-->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!---Home-->
            <ul class="navbar-nav me-auto order-0">

                <li class="nav-item active">
                    <a class="nav-link text-white" href="subject-list.php"><i class="fa fa-list" style="font-size:24px"></i>
                        Subject-List <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="mailpage.php"><i class="fa fa-pencil" style="font-size:30px"></i>Elective-Allocation<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo ' <li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Logout </a>
        </li>';
        } else {
            '<li class="nav-item btn btn-secondary active">
          <a class="nav-link text-white" href="adminlogin.php"><i class="fa fa-sign-in" style="font-size:24px"></i><span class="sr-only">(current)</span>
            Login </a>
        </li>';
        }
        ?>
    </nav>
    <!--Nav Ends---->
    <!-----------------NAV BAR ENDS---------------------->
    <!----------------TITLE TAG STARTS-------------------------->
    <center>
        <h1 style="color: #00008B; font-family: serif">Welcome! Admin</b></h1>
    </center>
    <center><img class="logo" src="annaunivlogo.webp" alt="logo" width="200" height="160"></center>
    <br>
    <!----------------TITLE TAG ENDS-------------------------->
</body>

</html>