<!DOCTYPE html>
<html lang="en">
<?php
session_start();
echo $_SESSION['cnic'];
if(!isset($_SESSION['cnic'])|| $_SESSION['userrole']==='user')
{
    header('Location:../login.php');
}

if(isset($_POST['logout']))
{
    session_unset();
    session_destroy();

    header("Location:../login.php");
}
if(isset($_POST['submit']))
{
$url = 'http://18.219.43.174:3000/api/userData';
 
//Initiate cURL.
$ch = curl_init($url);
 
//The JSON data.
$jsonData = array(

    '$class' => "org.example.basic.UserData",
    "Cnic"=> $_SESSION['creationid'],
    "FatherCnic"=> $_POST['FCNIC'],
    "MotherCnic"=> $_POST['MCNIC'],
    "owner"=> "resource:org.example.basic.User#".$_SESSION['creationid'],
    "Name"=> $_POST['Name'],
    "fathername"=> $_POST['Fname'],
    "mothername"=> $_POST['Mname'],
    "Religion"=> $_POST['Religion'],
    "BloodGroup"=> $_POST['BloodGroup'],
    "MartialStatus"=> $_POST['maritialstatus'],
    "Education"=> $_POST['education'],
    "Profession"=> $_POST['profession'],
    "gender"=> $_POST['gender'],
    "countryStay"=> $_POST['country'],
    "bDate"=> $_POST['dateofbirth']."T00:00:00.000Z",
    "rAddress"=> $_POST['raddress'],
    "pAddress"=> $_POST['paddress'],
    "language"=> $_POST['lang'],
    "PhoneNo"=> $_POST['phno'],
    "Email"=> $_POST['email'],
    "image"=> 0,
    "sign"=> 0
);
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$result = curl_exec($ch);
print_r($jsonDataEncoded);

header("Location:index.php");
}
// {
//     $class=$_POST['$class'];
//     $cnic=$_POST['cnic'];
//     $pass=$_POST['password'];
//     $thumb=$_POST['thumb'];
//     $role=$_POST['role'];
//     echo $class.$cnic.$pass.$thumb.$role;
    
// }
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
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="../vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
            <a href="./../login.php">
                    <img src="../images/icon/logo-white.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                   
                   <h2 >Admin Access</h2>
                   <h4 class="name">ID: <?php echo $_SESSION['cnic']; ?></h4>
   
                   
                   </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                    <li >
                            <a class="js-arrow" href="index.php">
                                    <i class="fas fa-chart-bar"></i>Dashboard</a>
                            </a>
                        </li>
                        <li>
                            <a class="js-arrow" href="./../logout.php">
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
                            <a href="./../login.php">
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
                        <h4 class="name">Admin</h4>
                        <a href="./logout.php">Sign out</a>
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
                                        <a href="index.php">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
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
                                                Add User
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
                    <div class="container-fluid">
                        <div class="login-form">
                            <form action="" id="add" method="post" enctype='application/json' >
                            <div class="form-group">
                                    <br>
                                    <label>Class</label>
                                    <input required class="au-input au-input--full" type="text" name="$class" id="$class" value="org.example.basic.UserData" disabled>
                                </div>
                                <div class="form-group">
                                        <label>CNIC</label>
                                        <input disabled value="<?php echo  $_SESSION['creationid'];?>" class="au-input au-input--full" type="text" name="cnic" id="cnic" >
                                </div>
                                <div class="form-group">
                                        <label>Name</label>
                                        <input required class="au-input au-input--full" type="text" name="Name" id="Name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control-sm form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                        </select>                          
                                            
                                    </div>
                                <div class="form-group">
                                        <label>Father Name</label>
                                        <input required class="au-input au-input--full" type="text" name="Fname" id="Fname" placeholder="Father Name">
                                </div> 
                                <div class="form-group">
                                        <label>Father CNIC</label>
                                        <input required class="au-input au-input--full" type="text" name="FCNIC" id="FCNIC" placeholder="Father CNIC">
                                </div> 
                                <div class="form-group">
                                        <label>Mother Name</label>
                                        <input required class="au-input au-input--full" type="text" name="Mname" id="Mname" placeholder="Mother Name">
                                        </div> 
                                <div class="form-group">
                                        <label>Mother CNIC</label>
                                        <input required class="au-input au-input--full" type="text" name="MCNIC" id="MCNIC" placeholder="Mother CNIC">
                                </div> 
                                <div class="form-group">
                                        <label>Religion</label>
                                        <input required class="au-input au-input--full" type="text" name="Religion" id="Religion" placeholder="Religion">
                                </div> 
                                <div class="form-group">
                                        <label>Blood Group</label>
                                        <input required class="au-input au-input--full" type="text" name="BloodGroup" id="BloodGroup" placeholder="Blood Group">
                                </div> 
                                
                                <div class="form-group">
                                        <label>Maritial Status</label>
                                        <select name="maritialstatus" id="maritialstatus" class="form-control-sm form-control">
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                        </select>                          
                                            
                                    </div>
                                
                                <div class="form-group">
                                    <label>Education</label>
                                    <input required class="au-input au-input--full" type="text" name="education" id="education" placeholder="Education">
                                </div> 
                                <div class="form-group">
                                        <label>Profession</label>
                                        <input required class="au-input au-input--full" type="text" name="profession" id="profession" placeholder="Profession">
                                </div> 
                                <div class="form-group">
                                        <label>Country</label>
                                        <input required class="au-input au-input--full" type="text" name="country" id="BloodGroup" placeholder="Country">
                                </div> 
                                <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input required class="au-input au-input--full" type="date" name="dateofbirth" id="dateofbirth" placeholder="Blood Group">
                                </div> 
                                <div class="form-group">
                                        <label>Residential Address</label>
                                        <input required class="au-input au-input--full" type="text" name="raddress" id="raddress" placeholder="Residential Address">
                                </div> 
                                <div class="form-group">
                                        <label>Permanent Address</label>
                                        <input required class="au-input au-input--full" type="text" name="paddress" id="paddress" placeholder="Permanent Address">
                                </div> 
                                <div class="form-group">
                                        <label>Language</label>
                                        <input required class="au-input au-input--full" type="text" name="lang" id="lang" placeholder="Language">
                                </div> 
                                <div class="form-group">
                                        <label>Phone Number</label>
                                        <input required class="au-input au-input--full" type="tel" name="phno" id="phno" placeholder="Phone Number">
                                </div> 
                                <div class="form-group">
                                        <label>Email</label>
                                        <input required class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email">
                                </div> 
                                <!--div class="form-group" >
                                        <label>image</label-->
                                        <!-- <input required class="au-input au-input--full" type="text" name="image" id="email" placeholder="Email">
                                </div> 
                                <div class="form-group">
                                        <label>Phone Number</label>
                                        <input required class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email">
                                </div>  -->



                            
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20"  id='submit' name='submit'  type="submit">Add User</button>
                                
                            </form>
                        </div>    
                    </div>  
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
        </div>

    </div>
    <!-- <script type="text/javascript">
	function redirect() {

		document.getElementById("add").submit();
	}
	window.onload = redirect; -->
</script>
    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>
    <script src="../vendor/vector-map/jquery.vmap.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

</body>

</html>
<!-- end document-->