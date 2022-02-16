<?php
$koneksi->query("DELETE FROM servis WHERE id_servis='$_GET[id]'");

echo "<script>location='index.php?halaman=servis';</script>";
// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
echo "<script>alert('Data Telah Dihapus');</script>";
