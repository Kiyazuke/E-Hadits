<?php
    include "koneksi.php";
    $folder = 'img/hadits/';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description" content="Hadits Shahih">
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
    <title>E-Hadits</title>

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
    <!-- <link rel="stylesheet" href="css/jquery.mb.YTPlayer.min.css"> -->
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
                        <h1 class="text-white mb-0">Kumpulan Hadits Shahih</h1>
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0">
                                <li class="list-inline-item breadcrumb-item"><a href="#">Kumpulan Hadits Shahih</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    <!--blog section start-->
    <section class="our-blog-section ptb-100 gray-light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading mb-5">
                        <h2>Hadits Shahih</h2>
                        <p>
                            Hadits Shahih adalah hadits yang sanadnya bersambung, diriwayatkan oleh periwayat yang 'adil dan dhâbith hingga bersambung kepada Rasulullah atau pada sanad terakhir berasal dari kalangan sahabat tanpa mengandung syâdz (kejanggalan) ataupun 'illat (cacat).
                        </p>
                    </div>
                </div>
            </div>
            <div class="card text-light rounded mb-3" style="background-image: linear-gradient(to right, rgba(32, 40, 119, 0.95), rgba(55, 46, 149, 0.95), rgba(83, 49, 177, 0.90), rgba(114, 48, 205, 0.85), rgba(150, 41, 230, 0.95));"> 
                <div class="card-body">
                    <form method="get" action="">
                    <div class="row">
                        <div class="col-7 col-md-6">
                            <div class="input-group">
                                <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Judul Hadits" aria-label="Search" aria-describedby="Cari Judul Hadits" value="">
                            </div>
                        </div>

                        <div class="col-5 col-md-4 text-right">
                            <span class="mr-3">Show:</span>
                            <div class="d-inline-block">
                                <select name="showNumber" id="showNumber" class="form-control" aria-label="Show">
                                    <option value="6">6</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="24">24</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <input type="submit" class="btn btn-light btn-block form-control form-control-sm border-radius" value="Search" name="search">
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <!-- SEARCH FUNCTION -->
                <?php
                if(isset($_GET['search'])){
                    $cari = $_GET['cari'];

                    $data = mysqli_query($db,"SELECT id, no, title, brief, foto FROM hadits WHERE title LIKE '%".$cari."%' order by no asc");
                    $jumlah_data = mysqli_num_rows($data);

                    $batas = $_GET['showNumber'];
                    if ($batas == "all") {
                        $batas = $jumlah_data;
                    }
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    if($jumlah_data<1){
                     echo'<center>Tidak Ada Data</center>';
                    }else{
                    $total_halaman = ceil($jumlah_data / $batas);
     
                    $data_hadits = mysqli_query($db,"SELECT id, no, title, brief, foto FROM hadits WHERE title LIKE '%".$cari."%' order by no asc limit $halaman_awal, $batas");
                    $nomor = $halaman_awal+1;
                    while($data = mysqli_fetch_array($data_hadits)){
                ?>
                <div class="col-md-4">
                    <div class="single-blog-card card border-0 shadow-sm">
                        <span class="category position-absolute badge badge-pill badge-primary"><?php echo $data['no']; ?></span>
                        <div style="background: url('<?php echo $folder.$data['foto']; ?>') no-repeat center center;" class="card-img-fixed"></div>
                        <div class="card-body">
                            <h3 class="h5 card-title two-lines">
                                <a href="detailHadits.php?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
                            </h3>
                            <p class="card-text three-lines brief"><?php echo $data['brief']; ?></p>
                            <a href="detailHadits.php?id=<?php echo $data['id']; ?>" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                }
                
                else{
                    $data = mysqli_query($db,"SELECT id, no, title, brief, foto FROM hadits order by no asc");
                    $jumlah_data = mysqli_num_rows($data);

                    $batas = 6;
                    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;    

                
                    if($jumlah_data<1){
                     echo'<center>Tidak Ada Data</center>';
                    }else{
                    $total_halaman = ceil($jumlah_data / $batas);
     
                    $data_hadits = mysqli_query($db,"SELECT id, no, title, brief, foto FROM hadits order by no asc limit $halaman_awal, $batas");
                    $nomor = $halaman_awal+1;
                    while($data = mysqli_fetch_array($data_hadits)){
                ?>
                <div class="col-md-4">
                    <div class="single-blog-card card border-0 shadow-sm">
                        <span class="category position-absolute badge badge-pill badge-primary"><?php echo $data['no']; ?></span>
                        <div style="background: url('<?php echo $folder.$data['foto']; ?>') no-repeat center center;" class="card-img-fixed"></div>
                        <div class="card-body">
                            <h3 class="h5 card-title two-lines">
                                <a href="detailHadits.php?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
                            </h3>
                            <p class="card-text three-lines brief"><?php echo $data['brief']; ?></p>
                            <a href="detailHadits.php?id=<?php echo $data['id']; ?>" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                }
                ?>
            </div>

            <!--pagination start-->
            <div class="row">
                <div class="col-md-12">
                    <nav class="custom-pagination-nav mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>><span class="ti-angle-left"></span></a>
                            </li>
                            <?php 
                                for($x=1;$x<=$total_halaman;$x++){
                            ?> 
                            <li class="page-item <?php if ($x == $halaman ) {echo 'active';} ?>">
                                <a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?>
                                </a>
                            </li>
                            <?php
                                }
                            ?>              
                            <li class="page-item">
                                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>><span class="ti-angle-right"></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--pagination end-->

        </div>
    </section>
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
<!-- <script src="js/jquery.mb.YTPlayer.min.js"></script> -->
<!--wow js-->
<script src="js/wow.min.js"></script>
<!--owl carousel js-->
<script src="js/owl.carousel.min.js"></script>
<!--countdown js-->
<script src="js/jquery.countdown.min.js"></script>
<!--custom js-->
<script src="js/scripts.js"></script>
<script type="text/javascript">
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const cari = urlParams.get('cari')
    console.log(cari);

    const showNumber = urlParams.get('showNumber')
    console.log(showNumber);
    if(cari != ""){
        $('#cari').val(cari);
    }

    if (showNumber != "") {
        $('#showNumber option[value='+showNumber+']').attr('selected','selected');
    }
    
</script>
</body>
</html>