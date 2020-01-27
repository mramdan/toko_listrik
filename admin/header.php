<?php
session_start();
if (empty($_SESSION['admin'])) {
  //session_destroy();
  echo "<script>location='login.php'</script>";
  die();
} else {
  include "../koneksi.php";
  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>

    <title>Halaman Utama Admin</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container">
        <a class="navbar-brand" href="index.php">Toko Umar</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="barang.php">Data Barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pelanggan.php">Data Pelanggan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="transaksi.php">Data Transaksi</a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <a href="logout.php" data-toggle="tooltip" data-placement="bottom" title="Logout" class="btn btn-danger navbar-btn" role="button"><span class="glyphicon glyphicon-off"></span> Logout</a>
          </ul>
        </div>
    </nav>
  <?php } ?>