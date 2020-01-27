<?php
session_start();
$id_barang = $_GET["id"];
unset($_SESSION["keranjang"][$id_barang]);

echo "<script>alert('produk telah di hapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
