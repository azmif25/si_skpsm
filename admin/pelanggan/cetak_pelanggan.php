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
<div class="col-12">
    <div class="card">
        <div class="card-header text-center">
            <h3>
                <b>Data Pelanggan</b>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $nomor++; ?></td>
                            <td style="padding-left: 30px;"><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td><?php echo $pecah['telp_pelanggan'] ?></td>
                            <td><?php echo $pecah['alamat_pelanggan'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <script>
                        window.print();
                    </script>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>