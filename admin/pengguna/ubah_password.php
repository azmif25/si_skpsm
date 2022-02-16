<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
</style>
<div class="col-md-9">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><b>Ubah Password</b></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Password Baru
                    </label>
                    <input type="password" name="password" class="form-control" autocomplete="current-password" required autofocus placeholder="Masukan password baru..." id="id_password">
                    <span class="fa fa-fw fa-eye field-icon toggle-password" id="togglePassword" style="margin-right: 20px; cursor: pointer;"></span>
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

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php
if (isset($_POST['ubah'])) {
    $options = [
        'cost' => 10,
    ];
    $passwordku = $_POST['password'];
    $password_hash = password_hash($passwordku, PASSWORD_DEFAULT, $options);
    $koneksi->query("UPDATE pengguna 
        SET password='$password_hash'
		WHERE username='$_SESSION[username]'");
    echo "<script>alert('Password Anda Telah Diubah');</script>";
    echo "<script>location='index.php';</script>";
}
?>