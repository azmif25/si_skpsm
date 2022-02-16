<?php
$ambil = $koneksi->query("SELECT * FROM daftar_servis WHERE id_nama_servis='$_GET[id]'");
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
                    <label>Nama Servis</label>
                    <input type="text" class="form-control" name="nama_servis" value="<?php echo $pecah['nama_servis'] ?>">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <a href="index.php?halaman=daftar_servis" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE daftar_servis 
        SET nama_servis='$_POST[nama_servis]'
		WHERE id_nama_servis='$_GET[id]'");
    echo "<script>alert('Data Pelanggan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=daftar_servis';</script>";
}
?>