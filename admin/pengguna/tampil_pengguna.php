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

                $options = [
                    'cost' => 10,
                ];
                $passwordku = $_POST['password'];
                $password_hash = password_hash($passwordku, PASSWORD_DEFAULT, $options);
                $koneksi->query("INSERT INTO pengguna
			        (nama_pengguna, username, email, password, role)
			VALUES('$_POST[nama_pengguna]', 
                    '$_POST[username]', 
                    '$_POST[email]',
                    '$password_hash',
                    '$_POST[role]')");
                echo "<div class='alert alert-success'>Data Tersimpan</div>";
                echo "<meta http-equiv='refresh' content='1'>";
            }
            ?>
            <table class="table table-head-fixed text-nowrap table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Role</th>
                        <?php
                        if ($_SESSION['role'] == 'super_admin') {
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

                    $data = mysqli_query($koneksi, "select * from pengguna");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM pengguna limit $halaman_awal, $batas");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $pecah['nama_pengguna'] ?></td>
                            <td><?php echo $pecah['username'] ?></td>
                            <td><?php echo $pecah['email'] ?></td>
                            <td><?php echo $pecah['role'] ?></td>
                            <?php if ($_SESSION['role'] == 'super_admin') {
                                // echo '<button onclick="myFunction()">Click me</button>';
                                echo '<td class="text-center">';
                                echo '<a href="index.php?halaman=hapus_pengguna&id=';
                                echo $pecah['id_pengguna'];
                                echo '"';
                                echo ' class="btn btn-danger" onclick="myFunction()"> <i class="fas fa-trash"></i></a>';

                                echo ' <a href="index.php?halaman=ubah_pengguna&id=';
                                echo $pecah['id_pengguna'];
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
                                                    echo "href='?halaman=pengguna&page=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=pengguna&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=pengguna&page=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- /.card -->


<div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" name="nama_pengguna" class="form-control" placeholder="Nama Pengguna.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-Mail.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password.." required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role">
                                <option value="admin">Admin</option>
                                <option value="owner">Owner</option>
                            </select>
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