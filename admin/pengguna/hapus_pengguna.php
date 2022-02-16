<?php
$koneksi->query("DELETE FROM pengguna WHERE id_pengguna='$_GET[id]'");

echo "<script>location='index.php?halaman=pengguna';</script>";
// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
echo "<script>alert('Data Pengguna Telah Dihapus');</script>";
