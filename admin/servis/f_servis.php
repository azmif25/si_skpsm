<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <b>Frekuensi Servis Pelanggan</b>
            </h6>
            <div class="card-tools">
                <a href="servis/cetak_f.php" target="_blank" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i> Cetak</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-1" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">Frekuensi Melakukan Servis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $batas = 5;
                    $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC limit $halaman_awal, $batas");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $nomor++; ?></td>
                            <td style="padding-left: 30px;"><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td class="text-center"><?php $sql = $koneksi->query("SELECT * FROM servis WHERE id_pelanggan = $pecah[id_pelanggan]");
                                                    $total = mysqli_num_rows($sql);
                                                    if ($total == 0) {
                                                        echo "Belum Pernah";
                                                    } else {
                                                        echo $total;
                                                        echo " Kali";
                                                    } ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <script>
                        function myFunction() {
                            return confirm('Apakah anda yakin ingin menghapus ?');
                        }
                    </script>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=f_servis&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=f_servis&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=f_servis&page=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>