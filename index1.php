<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE telp_pelanggan='$_GET[telp]'");
$pecah = $ambil->fetch_assoc();
?>
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
        font-size: 12px;
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
                <label for="">
                    <h5>Tingkat Kepuasan</h5>
                </label> <br>
                <input type="hidden" name="id_pelanggan" value="<?php echo $pecah['id_pelanggan'] ?>">
                <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d") ?>">
                <div class="text-center">
                    <div class="radio col-up">
                        <input type="radio" name="kepuasan" value="Sangat Buruk">
                        <label for="">Sangat Buruk</label>
                        <span style='font-size:300%;'>&#128544;</span>
                    </div>&emsp;
                    <div class="radio col-up">
                        <input type="radio" name="kepuasan" value="Buruk">
                        <label for="">Buruk</label>
                        <span style='font-size:300%;'>&#128542;</span>
                    </div>&emsp;
                    <div class="radio col-up">
                        <input type="radio" name="kepuasan" value="Sedang" checked>
                        <label for="">Sedang</label>
                        <span style='font-size:300%;'>&#128528;</span>
                    </div>&emsp;
                    <div class="radio col-up">
                        <input type="radio" name="kepuasan" value="Puas">
                        <label for="">Puas</label>
                        <span style='font-size : 300%;'>&#128516;</span>
                    </div>&emsp;
                    <div class="radio col-up">
                        <input type="radio" name="kepuasan" value="Sangat Puas">
                        <label for="">Sangat Puas</label>
                        <span style='font-size:300%;'>&#128525;</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h5>Keritik & Saran</h5>
                <textarea name="kritik_saran" class="form-control item" placeholder="Masukan Kritik & Saran Jika ada..." cols="30" rows="3"></textarea>
            </div>
            <div class="form-group">
                <button name="save" class="btn btn-block create-account">Submit</button>
            </div>
        </form>
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
if (isset($_POST['save'])) {
    $koneksi->query("INSERT INTO tanggapan
			(kepuasan, kritik_saran, tanggal, id_pelanggan)
			VALUES('$_POST[kepuasan]',
                    '$_POST[kritik_saran]',
                    '$_POST[tanggal]',
                    '$_POST[id_pelanggan]')");
    echo "<div class='alert alert-success'>Data Tersimpan</div>";
    echo "<script>location='index2.php';</script>";
}
?>

</html>