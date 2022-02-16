<style>
    p {
        font-size: 15px;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="assets/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aplikasi KPSM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/akun.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nama_pengguna'] ?></a>
            </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php?halaman=ubah_password" class="nav-link  <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=ubah_password" ? "active" : ""); ?>">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Ubah Password
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link  <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php" ? "active" : ""); ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=pelanggan" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=pelanggan" ? "active" : ""); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pelanggan
                        </p>
                    </a>
                </li>
                <?php
                if ($_SESSION['role'] != 'owner') {
                    echo "<li class='nav-item'>";
                    echo "<a href='index.php?halaman=daftar_servis' class='nav-link";
                    if ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=daftar_servis") {

                        echo " active";
                    }
                    echo "'>";
                    echo "<i class='fas fa-tools'></i>
                        <p>
                            Daftar Nama Servis
                        </p>
                    </a>
                </li>";
                }
                ?>
                <li class="nav-item">
                    <a href="index.php?halaman=servis" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=servis" ? "active" : ""); ?>">
                        <i class="fas fa-users-cog"></i>
                        <p>
                            Servis Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=f_servis" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=f_servis" ? "active" : ""); ?>">
                        <i class="fas fa-users-cog"></i>
                        <p>
                            Frekuensi Servis Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=kepuasan" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=kepuasan" ? "active" : ""); ?>">
                        <i class="fas fa-poll"></i>
                        <p>
                            Ulasan Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=f_kepuasan" class="nav-link 
                    <?php
                    echo ("/si_skpsm/admin/index.php?halaman=f_kepuasan" == $_SERVER['REQUEST_URI'] ? "active" : ""); ?>">
                        <i class="fas fa-poll"></i>
                        <p>
                            Frekuensi Ulasan Pelanggan
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['role'] == 'super_admin') {
                    echo "<li class='nav-item'>";
                    echo "<a href='index.php?halaman=pengguna' class='nav-link";
                    if ($_SERVER['REQUEST_URI'] == "/si_skpsm/admin/index.php?halaman=pengguna") {

                        echo " active";
                    }
                    echo "'>";
                    echo "<i class='fas fa-user-cog'></i>
                        <p>
                            Pengguna
                        </p>
                    </a>
                </li>";
                } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>