<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
echo $_SESSION['cnic'];
if(!isset($_SESSION['cnic'])|| $_SESSION['userrole']==='admin')
{
    header('Location:./login.php');
}

if(isset($_POST['logout']))
{
    session_unset();
    session_destroy();
    header("Location:./login.php");
}


if(isset($_POST['submit']))
{
    $enabled=false;

    $string = file_get_contents("http://18.219.43.174:3000/api/userData/".$_SESSION['cnic']);
    $newitem=json_decode($string);
    $data= "Shared Data is  \nCNIC: ".$_SESSION['cnic']." \n";
    if(isset($_POST['name']))
    {
        $data.="Name: ".$newitem->Name ." \n";
        $enabled=true;
    }
    if(isset($_POST['gender']))
    {
        $data.="Gender: ".$newitem->gender." \n";
        $enabled=true;
    }
    if(isset($_POST['fname']))
    {
        $enabled=true;
        $data.="Father's Name: ".$newitem->fathername." \n";
    }
    if(isset($_POST['fcnic']))
    {
        $enabled=true;
        $data.="Father's CNIC: ".$newitem->FatherCnic." \n";
    }
    if(isset($_POST['mname']))
    {
        $enabled=true;
        $data.="Mother's Name: ".$newitem->mothername." \n";
    }
    if(isset($_POST['mcnic']))
    {
        $enabled=true;
        $data.="Mother's CNIC: ".$newitem->MotherCnic." \n";
    }
    if(isset($_POST['religion']))
    {
        $enabled=true;
        $data.="Religion: ".$newitem->Religion." \n";
    }
    if(isset($_POST['bloodgroup']))
    {
        $enabled=true;
        $data.="Blood Group: ".$newitem->BloodGroup." \n";
    }
    if(isset($_POST['mstatus']))
    {
        $enabled=true;
        $data.="Matitial Status: ".$newitem->MartialStatus." \n";
    }
    if(isset($_POST['country']))
    {
        $enabled=true;
        $data.="Country: ".$newitem->countryStay." \n";
    }
    if(isset($_POST['dob']))
    {
        $enabled=true;
        $last_space = strrpos($newitem->bDate, 'T');
        
        $data.="Date of Birth: ".substr($newitem->bDate,0,$last_space)." \n";
    }
    if(isset($_POST['language']))
    {
        $enabled=true;
        $data.="Language: ".$newitem->language." \n";
    }
    if(isset($_POST['phno']))
    {
        $enabled=true;
        $data.="Phone Number: ".$newitem->PhoneNo." \n";
    }
    if(isset($_POST['email']))
    {
        $enabled=true;
        $data.="Email Address: ".$newitem->Email." \n";
    }
   $_SESSION['data']=$data;

}
 ?>
     
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
            <a href="./login.php">
                    <img src="images/icon/logo-white.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                   
                   <h2 >User Access</h2>
                   <h4 class="name">ID: <?php echo $_SESSION['cnic']; ?></h4>
   
                   </div>
                   <nav class="navbar-sidebar2">
                       <ul class="list-unstyled navbar__list">
                       <li class=" has-sub">
                               <a class="js-arrow" href="index.php">
                                       <i class="fas fa-chart-bar"></i>Dashboard</a>
                               </a>
                           </li>
                           <li class="active has-sub">
                               <a class="js-arrow" href="shareData.php">
                                       <i class="fas fa-chart-bar"></i>Share Data</a>
                               </a>
                           </li>
                           <li>
                               <a class="js-arrow" href="./logout.php">
                                       <i class="fa fa-sign-out-alt"></i>Log Out</a>
                               </a>
                           </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                                </a>
                            </div>
                            <div class="header-button2">
                                
                                <div class="header-button-item">
                                   <form action="" method="POST"><button style="color:white;" name="logout" id="logout" type="submit" > <i class="zmdi zmdi-power"></i></button></form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <h1>
                                                Your Data
                                                </h1>
                                            </li>
                                            <li class="list-inline-item seprate">
                                            </li>
                                        </ul>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="main">
                <div class="section__content section__content--p30">
                    <div class="container-fluid"><br>
                    <div class="au-card au-card--bg-blue au-card-top-countries m-b-30" style="color:white;">

                    <form action="" Method='POST'>
                        <div class="row">

                            <div class="col-lg-5">
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" name="cnic" value="cnic" checked disabled> CNIC <br><br>
                            </div>


                        </div>
                        <div class="row">

                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-4">
                        <input type="checkbox" name="name" value="name" >&nbsp;Name <br><br>
                        <input type="checkbox" name="fname" value="fname"> &nbsp;Father's Name <br><br>
                        <input type="checkbox" name="mname" value="mname">&nbsp;Mother's Name <br><br>
                        <input type="checkbox" name="religion" value="religion">&nbsp;Religion <br><br>
                        <input type="checkbox" name="mstatus" value="mstatus">&nbsp;Maritial Status <br><br>
                        <input type="checkbox" name="education" value="education">&nbsp;Education <br><br>
                        <input type="checkbox" name="dob" value="dob">&nbsp;Date of Birth <br><br>
                        <input type="checkbox" name="phno" value="phno">&nbsp;Phone Number<br><br>
                        </div>
                        <div class="col-lg-4">
                        <input type="checkbox" name="gender" value="gender">&nbsp;Gender <br><br>
                        <input type="checkbox" name="fcnic" value="fcnic">&nbsp;Father's CNIC <br><br>
                        <input type="checkbox" name="mcnic" value="mcnic">&nbsp;Mother's CNIC <br><br>
                        <input type="checkbox" name="bloodgroup" value="bloodgroup">&nbsp;Blood Group <br><br>
                        <input type="checkbox" name="country" value="country">&nbsp;Country Stay <br><br>
                        <input type="checkbox" name="profession" value="profession">&nbsp;Profession <br><br>
                        <input type="checkbox" name="language" value="language">&nbsp;Language <br><br>
                        <input type="checkbox" name="email" value="email">&nbsp;Email Address <br><br>
                        </div>
                            </div>
                            <div class="row">

                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit" type="submit">Share Data</button>
                            </div>
<style>
.hidden{
    display:none;
}

.show{
    display:block;
}
</style>

                            </div>
                                <div  class="<?php if($enabled) echo 'show';else echo 'hidden';?>" style="text-align: center !important;margin:0;" id="data">
                                Just Save the QR Code and give it to someone who wants to access your data.
                            <br>
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $data;?>";
                                
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->