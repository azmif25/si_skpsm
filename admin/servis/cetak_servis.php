<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/si_skpsm/koneksi.php');
?>
<script>
    window.print();
</script>
<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-head text-center">
            <h4><b>Laporan Servis Pelanggan <?php $dt = $_POST['dari_tanggal'];
                                            echo $dt; ?> Hingga <?php $kt = $_POST['ke_tanggal'];
                                                                echo $kt; ?></b></h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal</th>
                        <th>Nama Servis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;

                    if (isset($_POST['tampil'])) {
                        // $daritgl = date('Y-m-d', strtotime($_POST["dari_tanggal"]));
                        // $ketgl = date('Y-m-d', strtotime($_POST["ke_tanggal"]));
                        $daritgl = $_POST['dari_tanggal'];
                        $ketgl = $_POST['ke_tanggal'];

                        $ambil = "SELECT * FROM servis INNER JOIN pelanggan ON servis.id_pelanggan = pelanggan.id_pelanggan
                        INNER JOIN daftar_servis ON servis.id_nama_servis = daftar_servis.id_nama_servis 
                         WHERE tanggal BETWEEN '$daritgl' AND '$ketgl' ORDER BY tanggal DESC";
                    }

                    $hasil = mysqli_query($koneksi, $ambil);
                    while ($pecah = mysqli_fetch_assoc($hasil)) {
                    ?>
                        <tr>
                            <td width="3%"><?php echo $nomor++ ?></td>
                            <td><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td><?php echo $pecah['tanggal'] ?></td>
                            <td><?php echo $pecah['nama_servis'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>