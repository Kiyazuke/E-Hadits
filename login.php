<?php
    include "koneksi.php";

    //3-4 koneksi
    session_start();
    if(!isset($_SESSION['username'])){
        if (isset ($_POST['login'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            //7-8data yang dikirim dari form
            $query = mysqli_query($db, "SELECT * FROM user WHERE username='$username' AND password='$password'");
            // query untuk mencocokan, apakah data ada di dalam database atau tidak
            $num= mysqli_num_rows($query);
            $data= mysqli_fetch_array($query);


            if ($num > 0) {//jika data ada maka akan diproses
             $_SESSION['username']      = $username;
             $_SESSION['fullname']          = $data['fullname'];
             $_SESSION['foto']          = $data['foto'];
             $_SESSION['role']         = $data['role'];

             if($data['role']=='member' || $data['role']=='moderator' ){
                echo'<script>location.href="index.php"</script>';
             }elseif($data['role']=='admin'){
                echo"<script>location.href='admin.php'</script>";
             }


            } else {//jika tidak ada ini yang akan di proses
             echo"<script>history.back();</script>";
            }
        }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"
          content="AppCo app landing page template or product landing page template helps you easily create websites for your app or product,  landing page template form promotion and many more.">
    <meta name="author" content="ThemeTags">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>

    <!--title-->
    <title>Admin</title>

    <!--favicon icon-->
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans&display=swap"
          rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!--animated css-->
    <link rel="stylesheet" href="css/animate.min.css">
    <!--ytplayer css-->
    <link rel="stylesheet" href="css/jquery.mb.YTPlayer.min.css">
    <!--Owl carousel css-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="css/responsive.css">

</head>
<body>

<!--body content wrap start-->
<div class="main">

    <!--hero section start-->
    <section class="hero-section full-screen gray-light-bg">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                    <!-- Image -->
                    <div class="bg-cover vh-100 ml-n3 background-img" style="background-image: url(img/hero-bg-2.jpg);">
                        <div class="position-absolute login-signup-content">
                            <div class="position-relative text-white col-md-12 col-lg-7">
                                <h2 class="text-white">Welcome Back !</h2>
                                <p class="lead">Keep your face always toward the sunshine - and shadows will fall behind you. Continually pursue fully researched niches whereas timely platforms. Credibly parallel task optimal catalysts for change after focused catalysts for change.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="login-signup-wrap px-4 px-lg-5 my-5">
                        <!-- Heading -->
                        <h1 class="text-center mb-1">
                            Sign In
                        </h1>
                        <p class="text-center mb-5">
                            Free access to our dashboard.
                        </p>

                        <!--login form-->
                        <form class="login-signup-form" name="login" action="" method="post" id="loginform">
                            <div class="form-group">
                                <label class="pb-1">Username </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="username">
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label class="pb-1">Password</label>
                                    </div>
                                    <!-- <div class="col-auto">
                                        <a href="password-reset.html" class="form-text small text-muted">
                                            Forgot password?
                                        </a>
                                    </div> -->
                                </div>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                </div>
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3" type="submit" name="login">
                                Sign in
                            </button>

                            <!-- Link -->
                            <p class="text-center">
                                <small class="text-muted text-center">
                                    Don't have an account yet? <a href="sign-up.html">Sign up</a>.
                                </small>
                            </p>

                        </form>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </section>
    <!--hero section end-->

</div>
<!--body content wrap end-->

<!--jQuery-->
<script src="js/jquery-3.5.0.min.js"></script>
<!--Popper js-->
<script src="js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="js/bootstrap.min.js"></script>
<!--Magnific popup js-->
<script src="js/jquery.magnific-popup.min.js"></script>
<!--jquery easing js-->
<script src="js/jquery.easing.min.js"></script>
<!--jquery ytplayer js-->
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<!--wow js-->
<script src="js/wow.min.js"></script>
<!--owl carousel js-->
<script src="js/owl.carousel.min.js"></script>
<!--countdown js-->
<script src="js/jquery.countdown.min.js"></script>
<!--custom js-->
<script src="js/scripts.js"></script>
</body>
</html>
<?php
    }else{
        echo"<script>location.href='admin.php'</script>";
    }
?>