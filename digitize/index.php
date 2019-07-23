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
                       <li class="active has-sub">
                               <a class="js-arrow" href="index.php">
                                       <i class="fas fa-chart-bar"></i>Dashboard</a>
                               </a>
                           </li>
                           <li class=" has-sub">
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
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="images/icon/logo-white.png" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="#">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="index.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="index3.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                    </li>
                                    <li>
                                        <a href="index4.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                    </li>
                                </ul>
                            </li>
                           
                            <li>
                                <a href="#">
                                    <i class="fas fa-shopping-basket"></i>eCommerce</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-trophy"></i>Features
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="table.html">
                                            <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-calendar-alt"></i>Calendar</a>
                                    </li>
                                    <li>
                                        <a href="map.html">
                                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Pages
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="login.html">
                                            <i class="fas fa-sign-in-alt"></i>Login</a>
                                    </li>
                                    <li>
                                        <a href="register.html">
                                            <i class="fas fa-user"></i>Register</a>
                                    </li>
                                    <li>
                                        <a href="forget-pass.html">
                                            <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-desktop"></i>UI Elements
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="button.html">
                                            <i class="fab fa-flickr"></i>Button</a>
                                    </li>
                                    <li>
                                        <a href="badge.html">
                                            <i class="fas fa-comment-alt"></i>Badges</a>
                                    </li>
                                    <li>
                                        <a href="tab.html">
                                            <i class="far fa-window-maximize"></i>Tabs</a>
                                    </li>
                                    <li>
                                        <a href="card.html">
                                            <i class="far fa-id-card"></i>Cards</a>
                                    </li>
                                    <li>
                                        <a href="alert.html">
                                            <i class="far fa-bell"></i>Alerts</a>
                                    </li>
                                    <li>
                                        <a href="progress-bar.html">
                                            <i class="fas fa-tasks"></i>Progress Bars</a>
                                    </li>
                                    <li>
                                        <a href="modal.html">
                                            <i class="far fa-window-restore"></i>Modals</a>
                                    </li>
                                    <li>
                                        <a href="switch.html">
                                            <i class="fas fa-toggle-on"></i>Switchs</a>
                                    </li>
                                    <li>
                                        <a href="grid.html">
                                            <i class="fas fa-th-large"></i>Grids</a>
                                    </li>
                                    <li>
                                        <a href="fontawesome.html">
                                            <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                    </li>
                                    <li>
                                        <a href="typo.html">
                                            <i class="fas fa-font"></i>Typography</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
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
                        <div class="row">
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-8">
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                <?php 
                                          $string = file_get_contents("http://18.219.43.174:3000/api/UserData/".$_SESSION['cnic']);
                                          $newitem=json_decode($string);
                                          // print_r($newitem);?>
                                                    <tr>
                                                        <td>CNIC</td>
                                                        <td class="text-right"><?php echo $newitem->Cnic;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td class="text-right"><?php echo $newitem->Name;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Father's Name</td>
                                                        <td class="text-right"><?php echo $newitem->fathername;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Father's CNIC</td>
                                                        <td class="text-right"><?php echo $newitem->FatherCnic;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mother's Name</td>
                                                        <td class="text-right"><?php echo $newitem->mothername;?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Mother's CNIC</td>
                                                        <td class="text-right"><?php echo $newitem->MotherCnic;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Religion</td>
                                                        <td class="text-right"><?php echo $newitem->Religion;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Blood Group</td>
                                                        <td class="text-right"><?php echo $newitem->BloodGroup;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Maritial Status</td>
                                                        <td class="text-right"><?php echo $newitem->MartialStatus;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education</td>
                                                        <td class="text-right"><?php echo $newitem->Education;?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Profession</td>
                                                        <td class="text-right"><?php echo $newitem->Profession;?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td class="text-right"><?php echo $newitem->gender;?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Country Stay</td>
                                                        <td class="text-right"><?php echo $newitem->countryStay;?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Date of Birth</td>
                                                        <td class="text-right"><?php 
                                                        $last_space = strrpos($newitem->bDate, 'T');
                                                        echo substr($newitem->bDate,0,$last_space);?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Residential Address</td>
                                                        <td class="text-right"><?php echo $newitem->rAddress;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Permanent Address</td>
                                                        <td class="text-right"><?php echo $newitem->pAddress;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Language</td>
                                                        <td class="text-right"><?php echo $newitem->language;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone Number</td>
                                                        <td class="text-right"><?php echo $newitem->PhoneNo;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td class="text-right"><?php echo $newitem->Email;?></td>
                                                    </tr>
                                                    <!--tr>
                                                        <td>Image</td>
                                                        <td class="text-right"><?php //echo $newitem->image;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sign</td>
                                                        <td class="text-right"><?php //echo $newitem->sign;?></td>
                                                    </tr-->
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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