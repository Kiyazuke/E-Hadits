<?php
    include "koneksi.php";
    session_start();
    if(isset($_SESSION['username'])){


        if (isset($_GET['action']) && $_GET['action']=="delete") {
            $id = $_GET['id'];

            $cek = mysqli_query($db, "SELECT * FROM hadits WHERE id = $id");
            if(mysqli_num_rows($cek) == 0){
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Tidak Ditemukan.</div>';
            }else{
                $delete = mysqli_query($db, "DELETE FROM hadits WHERE id = $id");
                if($delete){
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Berhasil Di Hapus.</div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Dihapus.</div>';
                }

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

    <style type="text/css">
        .bg-header{
            background-image: linear-gradient(to right, rgba(32, 40, 119, 1), rgba(55, 46, 149, 1), rgba(83, 49, 177, 1), rgba(114, 48, 205, 1), rgba(150, 41, 230, 1)) !important;
        }
    </style>

</head>
<body>

<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg bg-header">
        <div class="container text-center d-block">
            <a class="navbar-brand" href="admin.php"><h4 class="text-white">E-Hadits</h4></a>
        </div>
    </nav>
    <!--end navbar-->
</header>
<!--header section end-->

<!--body content wrap start-->
<div class="main">

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
            <div class="row">
                <div class="col-md-12 bg-light text-right mb-3">
                    <a href="tambahHadits.php" class="btn btn-success text-right">Tambah</a>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Title</th>
                          <th scope="col">Brief</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                            $batas = 10;
                            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
             
                            $previous = $halaman - 1;
                            $next = $halaman + 1;
                            
                            $data = mysqli_query($db,"SELECT * FROM hadits order by no asc");
                            $jumlah_data = mysqli_num_rows($data);
                            if($jumlah_data<1){
                             echo'<center>Tidak Ada Data</center>';
                            }else{
                            $total_halaman = ceil($jumlah_data / $batas);
             
                            $data_hadits = mysqli_query($db,"SELECT * FROM hadits order by no asc LIMIT $halaman_awal, $batas");
                            $nomor = $halaman_awal+1;
                            while($data = mysqli_fetch_array($data_hadits)){
                        ?>
                        <tr>
                          <th scope="row"><?php echo $data['no']; ?></th>
                          <td><?php echo $data['title']; ?></td>
                          <td class="three-lines"><?php echo $data['brief']; ?></td>
                          <td style="min-width: 175px;">
                            <div class="d-block" style="">
                                <a href="editHadits.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm d-inline-block">Edit</a>
                                <a href="admin.php?action=delete&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm d-inline-block">Delete</a>
                                <a href="detailHadits.php?id=<?php echo $data['id']; ?>" target="_blank" class="btn btn-success btn-sm d-inline-block">View</a>
                            </div>
                          </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                      </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-md-12 bg-light text-right mb-3">
                    <a href="logout.php" class="btn btn-danger text-right">Logout</a>
                </div>
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
    }else{//jika tidak terisi
     echo"<script>location.href='login.php'</script>";
    }
?>