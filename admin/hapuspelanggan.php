<?php
include '../koneksi.php';

$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");

echo "<script>alert('Data Pelanggan Berhasil dihapus!');</script>";
echo "<script>location='pelanggan.php'</script>";

?>