<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modal-primary">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </h6>

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
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <?php
            if (isset($_POST['save'])) {
                $koneksi->query("INSERT INTO daftar_servis
			(nama_servis)
			VALUES('$_POST[nama_servis]')");
                echo "<div class='alert alert-success'>Data Tersimpan</div>";
                // echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
                // echo "<script>window.location.reload();</script>";
                echo "<meta http-equiv='refresh' content='1'>";
            }
            ?>
            <table class="table table-head-fixed text-nowrap table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">No.</th>
                        <th>Nama Servis</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $batas = 5;
                    $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $data = mysqli_query($koneksi, "select * from daftar_servis ORDER BY nama_servis ASC");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM daftar_servis ORDER BY nama_servis ASC LIMIT $halaman_awal, $batas");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $nomor++; ?></td>
                            <td><?php echo $pecah['nama_servis'] ?></td>
                            <td class="text-center">
                                <a href="index.php?halaman=hapus_daftar&id=<?php echo $pecah['id_nama_servis']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ?')"><i class="fas fa-trash"></i></a>
                                <a href="index.php?halaman=ubah_daftar&id=<?php echo $pecah['id_nama_servis']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=daftar_servis&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=daftar_servis&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=daftar_servis&page=$next'";
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
                            <label>Nama Servis</label>
                            <input type="text" name="nama_servis" class="form-control" placeholder="Nama Servis.." required autofocus>
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