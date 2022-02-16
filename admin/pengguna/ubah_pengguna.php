<?php
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE id_pengguna='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="col-md-9">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Ubah Data Pengguna</b></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" name="nama_pengguna" value="<?php echo $pecah['nama_pengguna'] ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $pecah['username']; ?>">
                </div>
                <div class="form-group">
                    <label>E-Mail</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $pecah['email'] ?>">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option selected value="<?php echo $pecah['role'] ?>"><?php echo $pecah['role'] ?> </option>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <a href="index.php?halaman=pengguna" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE pengguna 
        SET nama_pengguna='$_POST[nama_pengguna]', 
            username='$_POST[username]', 
            email='$_POST[email]',
            role='$_POST[role]'
		WHERE id_pengguna='$_GET[id]'");
    echo "<script>alert('Data Pengguna Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=pengguna';</script>";
}
?>