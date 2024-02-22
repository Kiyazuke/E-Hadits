<?php
    include "koneksi.php";

    session_start();
    if(isset($_SESSION['username'])){

    $id = $_GET['id'];
    $query = mysqli_query($db, "SELECT * FROM hadits WHERE id = $id");
    $data = mysqli_fetch_array($query);  
    $jumlah_data = mysqli_num_rows($query);
    if ($jumlah_data == undefined || $jumlah_data == null || $jumlah_data == "" || $jumlah_data == "0") {
        header("Location: admin.php"); 
    }
    $folder = 'img/hadits/';
    $message = '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <script src="https://cdn.tiny.cloud/1/m7qiqmxqsrnaczparf4hqg06wmzisqbisk6ni4gu58y6gnos/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
    <script>
      tinymce.init({
        selector: 'textarea#detail',
        skin: 'bootstrap',
        plugins: 'lists, link, image, media, code',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
      });
    </script>

</head>
<body>

<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-header">
        <div class="container text-center d-block">
            <a class="navbar-brand" href="admin.php"><h4 class="text-white">E-Hadits</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>

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
                    <?php
                        if(isset($_POST['edit'])){
                         $title   = $_POST['title'];
                         $no      = $_POST['no'];
                         $brief   = $_POST['brief'];
                         $detail  = $_POST['detail'];
                         $foto    = $_FILES['images']['name'];

                         if(!empty($_FILES['images']['tmp_name'])){
                            $rndm = time().'_'.rand(100, 999).'.';
                            $tmp = explode('.', $foto);
                            $newfilename = $rndm.end($tmp);
                            move_uploaded_file($_FILES['images']['tmp_name'],$folder.$newfilename);

                            $query = mysqli_query($db, "UPDATE hadits SET no = '$no', title='$title',brief = '$brief', detail = '$detail', foto = '$newfilename' WHERE id='$id' ");
                            if (!$query) {
                                $message = mysqli_error($db);
                                echo "<div class='alert alert-danger' role='alert' id='alert-edit'>" . $message . "</div>";
                            }else{
                                unlink($folder.$data['foto']);
                                $message = "Data berhasil ditambahkan";
                                echo "<div class='alert alert-success' role='alert' id='alert-edit'>" . $message . "</div>";
                                echo"<script>location.href='admin.php'</script>";
                                exit(); // Terminate the script 
                            }
                         }else{
                            $foto = $data['foto'];
                            $query = mysqli_query($db, "UPDATE hadits SET no = '$no', title='$title',brief = '$brief', detail = '$detail', foto = '$foto' WHERE id='$id' ");
                            if (!$query) {
                                $message = mysqli_error($db);
                                echo "<div class='alert alert-danger' role='alert' id='alert-edit'>" . $message . "</div>";
                            }else{
                                $message = "Data berhasil ditambahkan";
                                echo "<div class='alert alert-success' role='alert' id='alert-edit'>" . $message . "</div>";
                                echo"<script>location.href='admin.php'</script>";
                            }
                         }
                        }

                        if(isset($_POST['back'])){
                            header("Location: admin.php"); 
                        }
                    ?>
                    <form method="post" action="" enctype="multipart/form-data" >
                      <div class="form-group">
                        <label for="v">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $data['title']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="v">No Hadits</label>
                        <input type="number" class="form-control" id="no" name="no" placeholder="" value="<?php echo $data['no']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="brief">Brief</label>
                        <textarea class="form-control" id="brief" name="brief" rows="3"><?php echo $data['brief']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="brief">Detail</label>
                        <textarea class="form-control" id="detail" name="detail" rows="6">
                            <?php echo $data['detail']; ?>
                        </textarea>
                      </div>

                      <div class="form-group">
                        <label for="images">Header Foto</label>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo $folder.$data['foto']; ?>" class="w-100">
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="images" class="btn btn-default" value=""/>
                                <p><?php echo $data['foto']; ?></p>
                            </div>
                        </div>
                      </div>

                      <div class="form-group text-center">
                        <a href="admin.php" class="btn btn-secondary border-radius mt-4 mb-3 mr-2">Back</a>
                        <input type="submit" class="btn btn-primary border-radius mt-4 mb-3" value="Edit" name="edit">
                      </div>
                    </form>
                </div>
            </div>

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