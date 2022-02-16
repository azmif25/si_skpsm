<?php
$ambil = $koneksi->query("SELECT * FROM tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan WHERE id_tanggapan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

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

<div class="col-md-9">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Ubah Data Kepuasan Pelanggan</b></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <select name="id_pelanggan" class="form-control">
                        <option selected value="<?php echo $pecah['id_pelanggan'] ?>"><?php echo $pecah['nama_pelanggan'] ?> </option>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM pelanggan");
                        while ($p = $sql->fetch_array()) {
                        ?>
                            <option value="<?php echo $p['id_pelanggan'] ?>"><?php echo $p['nama_pelanggan'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo $pecah['tanggal'] ?>">
                </div>
                <div class="form-group">
                    <label>Kepuasan</label>
                    <div class="text-center">
                        <div class="radio col-up">
                            <input type="radio" name="kepuasan" value="Sangat Buruk" <?php if ($pecah['kepuasan'] == "Sangat Buruk") {
                                                                                            echo "checked";
                                                                                        } ?>>
                            <span>Sangat Buruk</span>
                            <span style='font-size:200%;'>&#128544;</span>
                        </div>&emsp;
                        <div class="radio col-up">
                            <input type="radio" name="kepuasan" value="Buruk" <?php if ($pecah['kepuasan'] == "Buruk") {
                                                                                    echo "checked";
                                                                                } ?>>
                            <span>Buruk</span>
                            <span style='font-size:200%;'>&#128542;</span>
                        </div>&emsp;
                        <div class="radio col-up">
                            <input type="radio" name="kepuasan" value="Sedang" <?php if ($pecah['kepuasan'] == "Sedang") {
                                                                                    echo "checked";
                                                                                } ?>>
                            <span>Sedang</span>
                            <span style='font-size:200%;'>&#128528;</span>
                        </div>&emsp;
                        <div class="radio col-up">
                            <input type="radio" name="kepuasan" value="Puas" <?php if ($pecah['kepuasan'] == "Puas") {
                                                                                    echo "checked";
                                                                                } ?>>
                            <span>Puas</span>
                            <span style='font-size : 200%;'>&#128516;</span>
                        </div>&emsp;
                        <div class="radio col-up">
                            <input type="radio" name="kepuasan" value="Sangat Puas" <?php if ($pecah['kepuasan'] == "Sangat Puas") {
                                                                                        echo "checked";
                                                                                    } ?>>
                            <span>Sangat Puas</span>
                            <span style='font-size:200%;'>&#128525;</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kritik & Saran</label>
                        <textarea name="kritik_saran" cols="30" rows="5" class="form-control"><?php echo $pecah['kritik_saran'] ?></textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <a href="index.php?halaman=kepuasan" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE tanggapan 
        SET id_pelanggan='$_POST[id_pelanggan]', 
            kepuasan='$_POST[kepuasan]', 
            tanggal='$_POST[tanggal]',
            kritik_saran= '$_POST[kritik_saran]'
		WHERE id_tanggapan='$_GET[id]'");
    echo "<script>alert('Data Pelanggan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=kepuasan';</script>";
}
?>