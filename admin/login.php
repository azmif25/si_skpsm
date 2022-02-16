<?php

//memulai session
session_start();

//jika ditemukan session, maka user akan otomatis dialihkan ke halaman admin
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

//include koneksi database
require_once "../koneksi.php";

//jika tombol login ditekan, maka akan mengirimkan variabel yang berisi username dan password
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $userpass = $_POST['password']; //password yang di inputkan oleh user lewat form login

    //query ke database
    $sql = mysqli_query($koneksi, "SELECT username, password, role, nama_pengguna FROM pengguna WHERE username = '$username'");

    list($username, $password, $role, $nama) = mysqli_fetch_array($sql);

    //jika data ditemukan dalam database, maka akan melakukan validasi dengan password_verify
    if (mysqli_num_rows($sql) > 0) {

        /*
            validasi login dengan password_verify
            $userpass -----> diambil dari password yang diinputkan user lewat form login
            $password -----> diambil dari password dalam database
            */
        if (password_verify($userpass, $password)) {

            //buat session baru
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['nama_pengguna'] = $nama;
            $_SESSION['role']     = $role;

            //jika login berhasil, user akan diarahkan ke halaman admin
            header("Location: index.php");
            die();
        } else {
            //Jika password tidak cocok, maka user akan diarahkan ke form login dan menampilkan pesan error
            echo '<script language="javascript">
                        window.alert("LOGIN GAGAL! Silakan coba lagi");
                        window.location.href="./";
                      </script>';
        }
    } else {
        //jika data tidak ditemukan dalam database, maka user akan diarahkan ke halaman error maka user akan diarahkan ke form login dan menampilkan pesan error
        echo '<script language="javascript">
                    window.alert("LOGIN GAGAL! Silakan coba lagi");
                    window.location.href="./";
                  </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi AKPTPSM | Login Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
</head>

<body class="login-page" style="min-height: 466px;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="alert alert-info text-center" role="alert">
                    <h4><b>Aplkasi Analisis Kepuasan Pelanggan ""</b></h4>
                </div>
                <a class="h3"><b>Login</b></a>
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username..">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-edit"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password..">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button name="login" class="btn btn-primary btn-block">Log In <i class="fas fa-sign-in-alt"></i> </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./assets/dist/js/adminlte.min.js"></script>


</body>

</html>