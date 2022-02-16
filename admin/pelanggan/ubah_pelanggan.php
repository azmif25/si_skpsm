<?php
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="col-md-9">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Ubah Data Pelanggan</b></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan" value="<?php echo $pecah['nama_pelanggan'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Laki-Laki" <?php if ($pecah['jk'] == "Laki-Laki") {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                        <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="Perempuan" <?php if ($pecah['jk'] == "Perempuan") {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>No.HP Pelanggan</label>
                    <input type="text" class="form-control" name="telp_pelanggan" value="<?php echo $pecah['telp_pelanggan']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <textarea name="alamat_pelanggan" class="form-control" cols="30" rows="7"><?php echo $pecah['alamat_pelanggan'] ?></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <a href="index.php?halaman=pelanggan" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE pelanggan 
        SET nama_pelanggan='$_POST[nama_pelanggan]', 
            jk='$_POST[jk]',
            telp_pelanggan='$_POST[telp_pelanggan]', 
            alamat_pelanggan='$_POST[alamat_pelanggan]'
		WHERE id_pelanggan='$_GET[id]'");
    echo "<script>alert('Data Pelanggan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}
?>