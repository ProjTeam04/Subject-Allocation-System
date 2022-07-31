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
$sqlq ="SELECT department from users where email='$email'";
$rest = mysqli_query($conn, $sqlq);
$rowss = mysqli_fetch_assoc($rest);
$udep = $rowss['department'];
$sqry="SELECT * from academicyear order by sno desc limit 1";
$se = mysqli_query($conn, $sqry);
$rows = mysqli_fetch_assoc($se);
$yr = $rows['year'];
$se = $rows['sem'];
?>
<!-----AUTH SESSION ENDS-------------->

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="annaunivlogo.webp">

  <title>Subject-List</title>
  <link rel="icon" href="annaunivlogo.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css" media="print">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div>
    <center>
        <h2><b>Anna University Regional Campus - Tirunelveli</b></h2>
        <h3><b>Department of <?php echo $udep;?></b></h3>
        <h3><b>Academic Year - <?php echo $yr;?></b></h3><br>

    </center>
    <table class="table table-bordered table-light">
        <thead>
            <tr>
                <th colspan="6"><center>Theory</center></th>
            </tr>
            <tr>
                <th scope="col">SI.No</th>
                <th scope="col">Semester</th>
                <th scope="col">Department</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Title</th>
                <th scope="col" width="20%">Staff Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($se == 'odd'){
                $lf1 = "SELECT semester, fromdepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and semester in (1,3,5,7) and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures != 0 and practicals = 0) order by semester,regulation";
                $lf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and semester in (1,3,5,7) and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and semester in (1,3,5,7) and status = 'Accepted') and lectures != 0 and practicals = 0 order by semester,regulation";
                $pf1 = "SELECT semester, fromdepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and semester in (1,3,5,7) and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures = 0 and practicals != 0) order by semester,regulation";
                $pf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and semester in (1,3,5,7) and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and semester in (1,3,5,7) and status = 'Accepted') and lectures = 0 and practicals != 0 order by semester,regulation";
                $f3 = "SELECT * from electives where year = '$yr' and sem = '$se' and department ='$udep' order by semester,regulation";
            }
            else if($se == 'even'){
                $lf1 = "SELECT semester, fromdepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and semester in (2,4,6,8) and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures != 0 and practicals = 0) order by semester,regulation";
                $lf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and semester in (2,4,6,8) and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and semester in (2,4,6,8) and status = 'Accepted') and lectures != 0 and practicals = 0 order by semester,regulation";
                $pf1 = "SELECT semester, fromdepartment, coursecode, coursetitle from depwisepaper where todepartment = '$udep' and acyear = '$yr' and semester in (2,4,6,8) and status = 'Accepted' and coursecode in (SELECT coursecode from subjects where department = '$udep' and lectures = 0 and practicals != 0) order by semester,regulation";
                $pf2 = "SELECT * from subjects where category not in ('OE1','OE2','PE1','PE2','PE3','PE4','PE5') and department= '$udep' and semester in (2,4,6,8) and coursecode not in (SELECT coursecode from depwisepaper where fromdepartment = '$udep' and acyear = '$yr' and semester in (2,4,6,8) and status = 'Accepted') and lectures = 0 and practicals != 0 order by semester,regulation";
                $f3 = "SELECT * from electives where year = '$yr' and sem = '$se' and department ='$udep' order by semester,regulation";
            }

                $lres1 = mysqli_query($conn, $lf1);
                $lres2 = mysqli_query($conn, $lf2);
                $pres1 = mysqli_query($conn, $pf1);
                $pres2 = mysqli_query($conn, $pf2);
                $eres = mysqli_query($conn, $f3);
                $number = 1;
                if($lres1 && $lres2 && $eres){
                
                while ($row = mysqli_fetch_array($lres2)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                while ($row = mysqli_fetch_array($eres)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                while ($row = mysqli_fetch_array($lres1)) {
                        $sem = $row['semester'];
                        $dep = $row['fromdepartment'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
                $theory = $number - 1;
            }?>
            <tr>
                <th colspan="6"><center>Laboratory</center></th>
            </tr><?php
            if($pres1 && $pres2){
                
                while ($row = mysqli_fetch_array($pres2)) {
                        $sem = $row['semester'];
                        $dep = $row['department'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
            }
            while ($row = mysqli_fetch_array($pres1)) {
                        $sem = $row['semester'];
                        $dep = $row['fromdepartment'];
                        $cc = $row['coursecode'];
                        $ct = $row['coursetitle'];
                        echo '<tr>
                            <th scope="row">' . $number . '</th>
                            <td>' . $sem . '</td>
                            <td>' . $dep . '</td>
                            <td>' . $cc . '</td>
                            <td>' . $ct . '</td>
                            <td></td>
                            
                            </tr>';
                        $number++;
                }
        $totalpaper = $number - 1;
        $totalstaff = 0;
        $lab = $totalpaper - $theory;
        $minstaff = $lab;
        $extrastaff = 0;
        $theorycovered = $minstaff * 2;
        $balancetheory = $theory - $theorycovered;
        if($balancetheory < 0){
            $totalstaff = $minstaff;
        }
        else if($balancetheory % 3 == 0){
            $extrastaff = $balancetheory / 3;
        }
        else{
            $extrastaff = ($balancetheory / 3) + 1;
        }
        $totalstaff = (int)($minstaff + $extrastaff);
        
    ?>  
    </tbody>
    </table>

    <div class="text-center">
        <form method="post">
        <button onclick="window.print();" class="btn btn-primary btn-lg" id="print-btn">Print</button>
        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">STAFF REQ.</button>

        </form>
    </div> 
    </div>
    <!-- popup starts-->
                    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" style="margin: 0 auto"><b>Staff Requirement Details</b></h1>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="card w-100" style="width: 18rem; margin: 0 auto">
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Total no of subjects</label>
                                                            <input class="form-control" type="number" placeholder="<?php echo $totalpaper;?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Total no of Laboratory subjects</label>
                                                            <input class="form-control" type="number" placeholder="<?php echo $lab;?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Total no of Theory subjects</label>
                                                            <input class="form-control" type="number" placeholder="<?php echo $theory;?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Total no of Staffs Required</label>
                                                            <input class="form-control" type="number" placeholder="<?php echo $totalstaff;?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <?php
            echo '<button type="button" class="btn btn-primary" id="print-btn"><a href="staffreq.php?dep='.urlencode($udep).'&totalstaff='.$totalstaff.'&lab='.$lab.'&theory='.$theory.'" class="text-light">Confirm</a></button>'; ?>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        <!-- popup ends-->         
</body>
</html>
