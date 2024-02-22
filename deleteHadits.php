<?php
    include "koneksi.php";

    session_start();
    if(isset($_SESSION['username'])){

        $id = $_GET['id'];
        
        $cek = mysqli_query($db, "SELECT * FROM hadits WHERE id = $id");
        $data = mysqli_fetch_array($cek);  
        if(mysqli_num_rows($cek) == 0){
            echo"<script>history.back();</script>";
            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Tidak Ditemukan.</div>';
        }else{
            $delete = mysqli_query($db, "DELETE FROM hadits WHERE id = $id");
            if($delete){
                $folder = 'img/hadits/';
                unlink($folder.$data['foto']);
                echo"<script>history.back();</script>";
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Berhasil Di Hapus.</div>';
            }else{
                echo"<script>history.back();</script>";
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Dihapus.</div>';
            }

        }
        

    }else{//jika tidak terisi
     echo"<script>location.href='login.php'</script>";
    }