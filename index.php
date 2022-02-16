<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./assets/template.css" />

    <link rel="stylesheet" href="./admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Aplikasi AKPTPSM</title>
</head>

<style>
    .radio.col-up {
        display: inline-flex;
        flex-direction: column-reverse;
        align-items: center;
    }

    label {
        font-family: monospace;
        font-size: 18px;
    }

    h4 {
        font-family: monospace;
    }
</style>

<body>
    <div class="registration-form">
        <form method="POST">
            <div class="alert alert-info text-center" role="alert">
                <h4><b>Kepuasan Pelanggan Terhadap Pelayanan Service <i class="fas fa-tools"></i></b></h4>
            </div><br>
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="nama_pelanggan" class="form-control item" placeholder="Masukan Nama...">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Laki-Laki">
                    <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Perempuan">
                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="">No. Telepon</label>
                <input type="text" name="telp_pelanggan" class="form-control item" placeholder="Masukan No.HP...">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat_pelanggan" id="" class="form-control item" cols="30" rows="3" placeholder="Masukan Alamat..."></textarea>
            </div>
            <div class="form-group">
                <button name="lanjut" class="btn btn-block create-account">Selanjut nya <i class="fas fa-arrow-right"></i></button>
            </div>
        </form>
        <!-- <a href="index1.php?id=22133212" class="btn btn-light">next</a> -->
        <div class="social-media">
            <h5>Terima Kasih</h5>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./assets/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<?php
include 'koneksi.php';
if (isset($_POST['lanjut'])) {
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE telp_pelanggan='$_POST[telp_pelanggan]'");
    $yangcocok = $ambil->num_rows;
    if ($yangcocok == 1) {
        $ambil->fetch_assoc();
        // echo "<div class='alert alert-info'>Login Success</div>";
        // echo "<meta http-equiv='refresh' content='1;url=index1.php?telp=$_POST[telp_pelanggan]'>";
        echo "<script>location='index1.php?telp=$_POST[telp_pelanggan]';</script>";
    } else {
        $koneksi->query("INSERT INTO pelanggan
			(nama_pelanggan, jk, telp_pelanggan, alamat_pelanggan)
			VALUES('$_POST[nama_pelanggan]', '$_POST[jk]', '$_POST[telp_pelanggan]', '$_POST[alamat_pelanggan]')");
        // echo "<div class='alert alert-info'>Data Tersimpan</div>";
        // echo "<meta http-equiv='refresh' content='1;url=index1.php?telp=$_POST[telp_pelanggan]'>";
        echo "<script>location='index1.php?telp=$_POST[telp_pelanggan]';</script>";
    }
}
?>

</html>