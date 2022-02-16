<?php
$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>location='index.php?halaman=pelanggan';</script>";
// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
echo "<script>alert('Data Pelanggan Telah Dihapus');</script>";
