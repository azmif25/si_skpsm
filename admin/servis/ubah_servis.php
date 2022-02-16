<?php
$ambil = $koneksi->query("SELECT * FROM servis INNER JOIN pelanggan ON servis.id_pelanggan = pelanggan.id_pelanggan
                            INNER JOIN daftar_servis ON servis.id_nama_servis = daftar_servis.id_nama_servis WHERE id_servis='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="col-md-9">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Ubah Data Servis</b></h3>
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
                    <label>Nama Servis</label>
                    <select name="id_nama_servis" class="form-control">
                        <option selected value="<?php echo $pecah['id_nama_servis'] ?>"><?php echo $pecah['nama_servis'] ?> </option>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM daftar_servis");
                        while ($p = $sql->fetch_array()) {
                        ?>
                            <option value="<?php echo $p['id_nama_servis'] ?>"><?php echo $p['nama_servis'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo $pecah['tanggal'] ?>">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <a href="index.php?halaman=servis" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE servis 
        SET id_pelanggan='$_POST[id_pelanggan]', 
            id_nama_servis='$_POST[id_nama_servis]', 
            tanggal='$_POST[tanggal]'
		WHERE id_servis='$_GET[id]'");
    echo "<script>alert('Data Pelanggan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=servis';</script>";
}
?>