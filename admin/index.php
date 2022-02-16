<?php
session_start();

// jika tidak ada session/session kosong, maka user akan di arahkan ke halaman login
if (empty($_SESSION['username'])) {
  header("Location: login.php");
}

// include koneksi database
require_once "../koneksi.php";
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi AKPTPSM | <?php
                            if (isset($_GET['halaman'])) {
                              if ($_GET['halaman'] == 'pelanggan') {
                                echo "Pelanggan";
                              } elseif ($_GET['halaman'] == 'ubah_pelanggan') {
                                echo "Ubah Pelanggan";
                              } elseif ($_GET['halaman'] == 'ubah_kepuasan') {
                                echo "Ubah Tanggapan Pelanggan";
                              } elseif ($_GET['halaman'] == 'kepuasan') {
                                echo "Tanggapan Pelanggan";
                              } elseif ($_GET['halaman'] == 'pengguna') {
                                echo "Pengguna";
                              } elseif ($_GET['halaman'] == 'ubah_pengguna') {
                                echo "Ubah Data Pengguna";
                              } elseif ($_GET['halaman'] == 'servis') {
                                echo 'Servis Pelanggan';
                              } elseif ($_GET['halaman'] == 'ubah_servis') {
                                echo 'Ubah Servis Pelanggan';
                              } elseif ($_GET['halaman'] == 'daftar_servis') {
                                echo 'Daftar Servis';
                              } elseif ($_GET['halaman'] == 'ubah_daftar') {
                                echo 'Ubah Daftar Servis';
                              }
                            } else {
                              echo 'Dashboard';
                            }
                            ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> -->
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include "template/navbar.php" ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include "template/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?php
                if (isset($_GET['halaman'])) {
                  if ($_GET['halaman'] == 'pelanggan') {
                    echo "Pelanggan";
                  } elseif ($_GET['halaman'] == 'ubah_pelanggan') {
                    echo "Ubah Pelanggan";
                  } elseif ($_GET['halaman'] == 'ubah_kepuasan') {
                    echo "Ubah Tanggapan Pelanggan";
                  } elseif ($_GET['halaman'] == 'kepuasan') {
                    echo "Tanggapan Pelanggan";
                  } elseif ($_GET['halaman'] == 'pengguna') {
                    echo "Pengguna";
                  } elseif ($_GET['halaman'] == 'ubah_pengguna') {
                    echo "Ubah Data Pengguna";
                  } elseif ($_GET['halaman'] == 'servis') {
                    echo 'Servis Pelanggan';
                  } elseif ($_GET['halaman'] == 'ubah_servis') {
                    echo 'Ubah Servis Pelanggan';
                  } elseif ($_GET['halaman'] == 'daftar_servis') {
                    echo 'Daftar Servis';
                  } elseif ($_GET['halaman'] == 'ubah_daftar') {
                    echo 'Ubah Daftar Servis';
                  }
                } else {
                  echo 'Dashboard';
                }
                ?>
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                  <?php
                  if (isset($_GET['halaman'])) {
                    if ($_GET['halaman'] == 'pelanggan') {
                      echo "Pelanggan";
                    } elseif ($_GET['halaman'] == 'ubah_pelanggan') {
                      echo "Ubah Pelanggan";
                    } elseif ($_GET['halaman'] == 'kepuasan') {
                      echo "Tanggapan Pelanggan";
                    } elseif ($_GET['halaman'] == 'ubah_kepuasan') {
                      echo "Ubah Tanggapan Pelanggan";
                    } elseif ($_GET['halaman'] == 'pengguna') {
                      echo "Pengguna";
                    } elseif ($_GET['halaman'] == 'ubah_pengguna') {
                      echo "Ubah Data Pengguna";
                    } elseif ($_GET['halaman'] == 'servis') {
                      echo 'Servis Pelanggan';
                    } elseif ($_GET['halaman'] == 'ubah_servis') {
                      echo 'Ubah Servis Pelanggan';
                    } elseif ($_GET['halaman'] == 'daftar_servis') {
                      echo 'Daftar Servis';
                    } elseif ($_GET['halaman'] == 'ubah_daftar') {
                      echo 'Ubah Daftar Servis';
                    }
                  } else {
                    echo 'Dashboard';
                  }
                  ?>
                </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">

            <!-- Analisis kepuasan pelanggan terhadap pelayanan service mobil

            (Harus 5 outpu)
            Contoh nya, menu login, data pelanggan, emoticon kepuasan pelanggan, dll nya -->
            <?php
            if (isset($_GET['halaman'])) {
              if ($_GET['halaman'] == 'pelanggan') {
                include 'pelanggan/tampil_pelanggan.php';
              } elseif ($_GET['halaman'] == 'ubah_pelanggan' && $_SESSION['role'] != 'owner') {
                include 'pelanggan/ubah_pelanggan.php';
              } elseif ($_GET['halaman'] == 'hapus_pelanggan' && $_SESSION['role'] != 'owner') {
                include 'pelanggan/hapus_pelanggan.php';
              } elseif ($_GET['halaman'] == 'kepuasan') {
                include 'tanggapan/tampil_tanggapan.php';
              } elseif ($_GET['halaman'] == 'hapus_kepuasan' && $_SESSION['role'] == 'super_admin') {
                include 'tanggapan/hapus_tanggapan.php';
              } elseif ($_GET['halaman'] == 'ubah_kepuasan' && $_SESSION['role'] == 'super_admin') {
                include 'tanggapan/ubah_tanggapan.php';
              } elseif ($_GET['halaman'] == 'pengguna' && $_SESSION['role'] == 'super_admin') {
                include 'pengguna/tampil_pengguna.php';
              } elseif ($_GET['halaman'] == 'hapus_pengguna' && $_SESSION['role'] == 'super_admin') {
                include 'pengguna/hapus_pengguna.php';
              } elseif ($_GET['halaman'] == 'ubah_pengguna' && $_SESSION['role'] == 'super_admin') {
                include 'pengguna/ubah_pengguna.php';
              } elseif ($_GET['halaman'] == 'servis') {
                include 'servis/tampil_servis.php';
              } elseif ($_GET['halaman'] == 'hapus_servis' && $_SESSION['role'] != 'owner') {
                include 'servis/hapus_servis.php';
              } elseif ($_GET['halaman'] == 'ubah_servis' && $_SESSION['role'] != 'owner') {
                include 'servis/ubah_servis.php';
              } elseif ($_GET['halaman'] == 'daftar_servis' && $_SESSION['role'] != 'owner') {
                include 'daftar_servis/tampil_daftar.php';
              } elseif ($_GET['halaman'] == 'hapus_daftar' && $_SESSION['role'] != 'owner') {
                include 'daftar_servis/hapus_daftar.php';
              } elseif ($_GET['halaman'] == 'ubah_daftar' && $_SESSION['role'] != 'owner') {
                include 'daftar_servis/ubah_daftar.php';
              } elseif ($_GET['halaman'] == 'ubah_password') {
                include 'pengguna/ubah_password.php';
              } elseif ($_GET['halaman'] == 'f_kepuasan') {
                include 'tanggapan/f_tanggapan.php';
              } elseif ($_GET['halaman'] == 'f_servis') {
                include 'servis/f_servis.php';
              }
            } else {
              include 'dashboard.php';
            }
            ?>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <script src="assets/plugins/chart.js/Chart.js"></script>
  <script src="assets/plugins/jquery/jquery.js"></script>
</body>

</html>