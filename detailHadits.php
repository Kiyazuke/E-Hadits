<?php
    include "koneksi.php";

    $id = $_GET['id'];
    $query = mysqli_query($db, "SELECT * FROM hadits WHERE id = $id");
    $data = mysqli_fetch_array($query);  

    $jumlah_data = mysqli_num_rows($query);
    if ($jumlah_data == undefined || $jumlah_data == null || $jumlah_data == "" || $jumlah_data == "0") {
        header("Location: index.php"); 
    }

    $folder = 'img/hadits/';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"
          content="AppCo App Landing Page Template. agency landing page template helps you easily create websites for your business, marketing landing page template form promotion and many more.">
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
    <title>E-Hadits - <?php echo $data['title']; ?></title>

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

<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
        <div class="container text-center d-block">
            <a class="navbar-brand" href="index.php"><h4 class="text-white">E-Hadits</h4></a>
        </div>
    </nav>
    <!--end navbar-->
</header>
<!--header section end-->

<!--body content wrap start-->
<div class="main">

    <!--header section start-->
    <section class="hero-section ptb-100 background-img"
             style="background: url('img/hero-bg-2.jpg')no-repeat center center / cover">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">Detail Hadits</h1>
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0">
                                <li class="list-inline-item breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="list-inline-item breadcrumb-item active"><?php echo $data['title']; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    <!--blog section start-->
    <div class="module ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <!-- Post-->
                    <article class="post">
                        <div class="post-preview">
                            <span class="category position-absolute badge badge-pill badge-primary m-1" style="top: 15px;right: 30px;font-size: medium;"><?php echo $data['no']; ?></span>
                            <img src="<?php echo $folder.$data['foto']; ?>" alt="article" class="img-fluid"/>
                        </div>
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h1 class="post-title"><?php echo $data['title']; ?></h1>
                            </div>
                            <div class="post-content">
                                <?php echo $data['detail']; ?>
                            </div>
                            <!-- <div class="post-footer">
                                <div class="post-tags"><a href="#">Lifestyle</a><a href="#">Music</a><a href="#">News</a><a href="#">Travel</a></div>
                            </div> -->
                        </div>
                    </article>
                    <!-- Post end-->

                    <!--pagination start-->
                    <?php 
                        $no = $data['no'];
                        
                        $previous = $no - 1;
                        $next = $no + 1;
                        
                        $query_all_data = mysqli_query($db, "SELECT * FROM hadits");
                        $jumlah_data = mysqli_num_rows($query_all_data);

                        echo "<script>console.log('$no');</script>";
                        echo "<script>console.log('$jumlah_data');</script>";

                        if($no > 1){ 
                        $query_previous = mysqli_query($db, "SELECT * FROM hadits WHERE no = $previous");
                        $data_previous = mysqli_fetch_array($query_previous);  
                        $previous_id = $data_previous['id'];
                        }

                        if($no < $jumlah_data) {   
                        $query_next = mysqli_query($db, "SELECT * FROM hadits WHERE no = $next");
                        $data_next = mysqli_fetch_array($query_next);  
                        $next_id = $data_next['id'];
                        }
                        
                    ?>
                    <div class="row">
                        <div class="col-12 col-sm-6 py-3 px-0 pr-3 border">
                            <?php 
                            if($no > 1){ 
                            ?>
                                <a class="d-flex justify-content-start" href="?id=<?php echo $previous_id; ?>">
                                    <span class="ti-angle-left p-3"></span>
                                    <div>
                                        <span class="pagination-text">SEBELUMNYA</span>
                                        <span class="pagination-title"><?php echo $data_previous['title']; ?></span>
                                    </div>
                                </a>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="col-12 col-sm-6 py-3 px-0 pl-3 border">
                            <?php

                            if($no < $jumlah_data) {    
                            ?>
                                <a class="d-flex justify-content-end" href="?id=<?php echo $next_id;?>">
                                    <div>
                                        <span class="pagination-text text-right">SELANJUTNYA</span>
                                        <span class="pagination-title text-right"><?php echo $data_next['title']; ?></span>
                                    </div>
                                    <span class="ti-angle-right p-3"></span>
                                </a>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                    <!--pagination end-->

                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar-right pl-4">

                        <!-- Search widget-->
                        <!-- <aside class="widget widget-search">
                            <form>
                                <input class="form-control" type="search" placeholder="Type Search Words">
                                <button class="search-button" type="submit"><span class="ti-search"></span></button>
                            </form>
                        </aside> -->


                        <!-- Recent entries widget-->
                        <aside class="widget widget-recent-entries-custom">
                            <div class="widget-title">
                                <h6>Hadits Lainnya</h6>
                            </div>
                            <ul>
                                <?php
                                    $query = mysqli_query($db, "SELECT * FROM hadits ORDER BY RAND() asc LIMIT 0,5");
                                    $num = mysqli_num_rows($query);
                                    $no = 1;
                                    if($num<1){
                                     echo'<center>Tidak Ada Data</center>';
                                    }else{
                                        while($data=mysqli_fetch_array($query)){

                                ?>
                                <li class="clearfix">
                                    <div class="wi">
                                        <a href="detailHadits.php?id=<?php echo $data['id']; ?>">
                                            <div style="background: url('<?php echo $folder.$data['foto']; ?>') no-repeat center center;" class="card-img-fixed-sidebar"><span class="category position-absolute badge badge-pill badge-primary m-1"><?php echo $data['no']; ?></span></div>
                                        </a>
                                    </div>
                                    <div class="wb">
                                        <a href="detailHadits.php?id=<?php echo $data['id']; ?>" class="one-lines"><?php echo $data['title']; ?></a>
                                        <span class="post-date two-lines">
                                            <?php echo $data['brief']; ?>
                                        </span>
                                    </div>
                                </li>
                                <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog section end-->

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