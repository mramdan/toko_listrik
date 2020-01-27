<?php

include '../koneksi.php';

$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotobarang = $pecah['foto_barang'];
if (file_exists("../foto_barang/$fotobarang"))
{
    unlink("../foto_barang/$fotobarang");
}

$koneksi->query("DELETE FROM barang WHERE id_barang = '$_GET[id]'");

echo "<script>alert('Data Barang Berhasil dihapus!');</script>";
echo "<script>location='barang.php'</script>"

?>