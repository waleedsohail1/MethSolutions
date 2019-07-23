<!DOCTYPE html>
<html lang="en">

<?php
session_start();

    $string = file_get_contents("http://18.219.43.174:3000/api/user");
    $newitem=json_decode($string);
    foreach ($newitem as $item)
    {
        // echo $item->CNIC;
        // echo $item->Password;
        // echo $item->Thumbprint;
        // echo $item->userrole;

        if(isset($_POST['submit']))
        {

            if(($item->CNIC===$_POST['cnic']) && ($item->Password===$_POST['password'])&&($item->Thumbprint===$_POST['thumb'])&&($item->userrole==="admin"))
            {
                $_SESSION['cnic']=$item->CNIC;
                $_SESSION['userrole']="admin";
                if($item->Password===$item->CNIC)
                {
                    header('Location: ./firstlogin.php');
                    //Logged in first time
                // echo $item->Password;
                // echo $item->CNIC;

                }
                // // echo "Hello";
                else
                    header('Location: ./admin');
                

            }
            else if(($item->CNIC===$_POST['cnic']) && ($item->Password===$_POST['password'])&&($item->Thumbprint===$_POST['thumb'])&&($item->userrole==="user"))
            {
                $_SESSION['cnic']=$item->CNIC;
                $_SESSION['userrole']="user";

                if($item->Password===$item->CNIC)
                {
                    header('Location: ./firstlogin.php');
                    //Logged in first time

                }
                // echo "Hello";
                else

                header('Location: ./index.php');

            }

            
        }
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
    <title>Login - Digitize</title>

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

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>CNIC</label>
                                    <input class="au-input au-input--full" type="text" name="cnic" id="cnic" placeholder="CNIC (without Dashes)">
                                </div>
                                <div class="form-group">
                                        <label>Password</label>
                                        <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                        <label>Thumbprint</label>
                                        <input class="au-input au-input--full" type="password" name="thumb" id="thumb" placeholder="Thumbprint">
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit" type="submit">sign in</button>
                                
                            </form>
                            <div class="register-link">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->