<div class="col-12">
    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-2">
                    <h6 class="card-title">
                        <?php
                        if ($_SESSION['role'] != 'owner') {
                            echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-primary">
                            <i class="fa fa-plus"></i> Tambah Data</button>';
                        }
                        ?>
                    </h6>
                </div>
                <div class="col-8">
                    <form method="POST" action="servis/cetak_servis.php" class="form-inline row">
                        <div class="col-sm-1">
                            <label for="">Dari </label>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label for="">Dari Tanggal</label> -->
                                <input type="date" name="dari_tanggal" value="<?php echo date("Y-m-d") ?>" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Sampai </label>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <!-- <label for="">Sampai Tanggal</label> -->
                                <input type="date" name="ke_tanggal" value="<?php echo date("Y-m-d") ?>" class="form-control form-control-sm">
                            </div>
                        </div>&ensp;&ensp;&ensp;
                        <div class="col-sm-1">
                            <button name="tampil" formtarget="_blank" class="btn btn-outline-success btn-sm" style="width: 300%;"><i class="fas fa-print"></i> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 350px;">
            <?php
            if (isset($_POST['save'])) {
                $koneksi->query("INSERT INTO servis
			(id_nama_servis, tanggal, id_pelanggan)
			VALUES('$_POST[id_nama_servis]',
                    '$_POST[tanggal]',
                    '$_POST[id_pelanggan]')");
                echo "<div class='alert alert-success'>Data Tersimpan</div>";
                // echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
                // echo "<script>window.location.reload();</script>";
                echo "<meta http-equiv='refresh' content='1'>";
            }
            ?>
            <table class="table table-head-fixed text-nowrap table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal</th>
                        <th>Nama Servis</th>
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

                    $data = mysqli_query($koneksi, "select * from servis INNER JOIN pelanggan ON servis.id_pelanggan = pelanggan.id_pelanggan
                    INNER JOIN daftar_servis ON servis.id_nama_servis = daftar_servis.id_nama_servis ORDER BY tanggal DESC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM servis INNER JOIN pelanggan ON servis.id_pelanggan = pelanggan.id_pelanggan
                                                INNER JOIN daftar_servis ON servis.id_nama_servis = daftar_servis.id_nama_servis ORDER BY tanggal DESC
                                                LIMIT $halaman_awal, $batas");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td><?php echo $pecah['tanggal'] ?></td>
                            <td><?php echo $pecah['nama_servis'] ?></td>
                            <?php if ($_SESSION['role'] != 'owner') {
                                // echo '<button onclick="myFunction()">Click me</button>';
                                echo '<td class="text-center">';
                                echo '<a href="index.php?halaman=hapus_servis&id=';
                                echo $pecah['id_servis'];
                                echo '"';
                                echo ' class="btn btn-danger" onclick="myFunction()"> <i class="fas fa-trash"></i></a>';

                                echo ' <a href="index.php?halaman=ubah_servis&id=';
                                echo $pecah['id_servis'];
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
                                                    echo "href='?halaman=servis&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=servis&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=servis&page=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.card -->
</div>

<div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Servis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <select name="id_pelanggan" class="form-control">
                                <option disabled selected> Pilih </option>
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
                                <option disabled selected> Pilih </option>
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
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date("Y-m-d") ?>">
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