<div class="col-12">
    <div class="card">
        <div class="card-header">

            <!-- <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="card-title">
                        <?php
                        if ($_SESSION['role'] != 'owner') {
                            echo '<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modal-primary">
                            <i class="fa fa-plus"></i> Tambah Data</button>';
                        }
                        ?>

                    </h6>

                </div>
                <div class="col-sm-6 text-right">
                    <a href="pelanggan/cetak_pelanggan.php" class="btn btn-outline-info btn-sm" target="_blank"><i class="fas fa-print"></i> Cetak</a>

                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <?php
            if (isset($_POST['save'])) {
                $koneksi->query("INSERT INTO pelanggan
			(nama_pelanggan,jk,telp_Pelanggan,alamat_pelanggan)
			VALUES('$_POST[nama_pelanggan]',
            '$_POST[jk]', 
            '$_POST[telp_pelanggan]', 
            '$_POST[alamat_pelanggan]')");
                echo "<div class='alert alert-success'>Data Tersimpan</div>";
                echo "<meta http-equiv='refresh' content='1'>";
            }
            ?>
            <table class="table table-head-fixed text-nowrap table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <?php
                        if ($_SESSION['role'] != 'owner') {
                            echo '<th class="text-center">Aksi</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $batas = 5;
                    $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $data = mysqli_query($koneksi, "select * from pelanggan ORDER BY nama_pelanggan ASC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC limit $halaman_awal, $batas");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $nomor++; ?></td>
                            <td><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td><?php echo $pecah['telp_pelanggan'] ?></td>
                            <td><?php echo $pecah['alamat_pelanggan'] ?></td>
                            <?php if ($_SESSION['role'] != 'owner') {
                                // echo '<button onclick="myFunction()">Click me</button>';
                                echo '<td class="text-center">';
                                echo '<a href="index.php?halaman=hapus_pelanggan&id=';
                                echo $pecah['id_pelanggan'];
                                echo '"';
                                echo ' class="btn btn-danger" onclick="myFunction()"> <i class="fas fa-trash"></i></a>';

                                echo ' <a href="index.php?halaman=ubah_pelanggan&id=';
                                echo $pecah['id_pelanggan'];
                                echo '"';
                                echo 'class="btn btn-warning"><i class="far fa-edit"></i></a></td>';
                            } ?>
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
                                                    echo "href='?halaman=pelanggan&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=pelanggan&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=pelanggan&page=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pelangan</label>
                            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" value="Laki-Laki">
                                <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" value="Perempuan">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="telp_pelanggan" class="form-control" placeholder="No.HP Pelanggan.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat_pelanggan" class="form-control" placeholder="Alamat Pelanggan.." cols="30" rows="7"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer text-right">
                <button name="save" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>