<?php
$koneksi->query("DELETE FROM daftar_servis WHERE id_nama_servis='$_GET[id]'");

echo "<script>location='index.php?halaman=daftar_servis';</script>";
// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
echo "<script>alert('Data Telah Dihapus');</script>";
