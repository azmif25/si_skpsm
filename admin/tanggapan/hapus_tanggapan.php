<?php
$koneksi->query("DELETE FROM tanggapan WHERE id_tanggapan='$_GET[id]'");

echo "<script>location='index.php?halaman=kepuasan';</script>";
// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
echo "<script>alert('Data Telah Dihapus');</script>";
