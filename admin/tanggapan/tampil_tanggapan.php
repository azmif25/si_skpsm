<!-- <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../assets/plugins/datepicker/css/datepicker.css"> -->

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-2">
                    <!-- <h6 class="card-title"> -->
                    <?php
                    if ($_SESSION['role'] == 'super_admin') {
                        echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-primary">
                            <i class="fa fa-plus"></i> Tambah Data</button>';
                    }
                    ?>
                    <!-- </h6> -->
                </div>
                <div class="col-8">
                    <form method="POST" action="tanggapan/cetak_tanggapan.php" class="form-inline row">
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
                            <button name="tampil" formtarget="_blank" class="btn btn-outline-success btn-sm" style="width: 300%;">Cetak</button>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 350px;">
            <?php
            if (isset($_POST['save'])) {
                $koneksi->query("INSERT INTO tanggapan
			(kepuasan, kritik_saran, tanggal, id_pelanggan)
			VALUES('$_POST[kepuasan]',
                    '$_POST[kritik_saran]',
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
                        <th>Tingkat Kepuasan</th>
                        <th>Kritik & Saran</th>
                        <?php
                        if ($_SESSION['role'] == 'super_admin') {
                            echo '<th class="text-center">Aksi</th>';
                        }
                        ?>
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

                        $batas = 100000;
                        $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($koneksi, "SELECT * from tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan 
                        WHERE tanggal BETWEEN '$daritgl ' AND '$ketgl' ORDER BY tanggal DESC");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        $ambil = "SELECT * FROM tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan 
                         WHERE tanggal BETWEEN '$daritgl' AND '$ketgl' ORDER BY tanggal DESC";
                    } else {
                        $batas = 5;
                        $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($koneksi, "select * from tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan 
                        ORDER BY tanggal DESC");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        $ambil = "SELECT * FROM tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan 
                    ORDER BY tanggal DESC limit $halaman_awal, $batas";
                    }

                    $hasil = mysqli_query($koneksi, $ambil);
                    while ($pecah = mysqli_fetch_assoc($hasil)) {
                    ?>
                        <tr>
                            <td width="3%"><?php echo $nomor++ ?></td>
                            <td><?php echo $pecah['nama_pelanggan'] ?></td>
                            <td><?php echo $pecah['jk'] ?></td>
                            <td><?php echo $pecah['tanggal'] ?></td>
                            <td><?php echo $pecah['kepuasan'] ?></td>
                            <td><?php echo $pecah['kritik_saran'] ?></td>
                            <?php if ($_SESSION['role'] == 'super_admin') {
                                // echo '<button onclick="myFunction()">Click me</button>';
                                echo '<td class="text-center">';
                                echo '<a href="index.php?halaman=hapus_kepuasan&id=';
                                echo $pecah['id_tanggapan'];
                                echo '"';
                                echo ' class="btn btn-danger" onclick="myFunction()"> <i class="fas fa-trash"></i></a>';

                                echo ' <a href="index.php?halaman=ubah_kepuasan&id=';
                                echo $pecah['id_tanggapan'];
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
                                                    echo "href='?halaman=kepuasan&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=kepuasan&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=kepuasan&page=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.card -->
</div>

<style>
    .radio.col-up {
        display: inline-flex;
        flex-direction: column-reverse;
        align-items: center;
    }

    label {
        font-family: monospace;
        font-size: 18px;
    }

    h4 {
        font-family: monospace;
    }
</style>
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
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date("Y-m-d") ?>">
                        </div>
                        <div class="form-group">
                            <label>Tingkat Kepuasan</label><br>
                            <div class="text-center">
                                <div class="radio col-up">
                                    <input type="radio" name="kepuasan" value="Sangat Buruk">
                                    <span>Sangat Buruk</span>
                                    <span style='font-size:200%;'>&#128544;</span>
                                </div>&emsp;
                                <div class="radio col-up">
                                    <input type="radio" name="kepuasan" value="Buruk">
                                    <span>Buruk</span>
                                    <span style='font-size:200%;'>&#128542;</span>
                                </div>&emsp;
                                <div class="radio col-up">
                                    <input type="radio" name="kepuasan" value="Sedang" checked>
                                    <span>Sedang</span>
                                    <span style='font-size:200%;'>&#128528;</span>
                                </div>&emsp;
                                <div class="radio col-up">
                                    <input type="radio" name="kepuasan" value="Puas">
                                    <span>Puas</span>
                                    <span style='font-size : 200%;'>&#128516;</span>
                                </div>&emsp;
                                <div class="radio col-up">
                                    <input type="radio" name="kepuasan" value="Sangat Puas">
                                    <span>Sangat Puas</span>
                                    <span style='font-size:200%;'>&#128525;</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kritik dan Saran</label>
                            <textarea name="kritik_saran" cols="30" rows="4" class="form-control" placeholder="Kritik & Saran ..."></textarea>
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