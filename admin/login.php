<?php
session_start();
include '../koneksi.php'
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

    <title>Login Admin</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <img src="foto.jpg" class="img img-fluid" alt="">
    <form class="form-signin" method="post">
        <div class="text-center mb-4">
            <img src="foto.jpg" alt="" width="72" height="72">

            <h1 class="h3 mb-3 font-weight-normal">Login Admin</h1>
            <p>Selamat datang di halaman login admin Toko Umar</a></p>
        </div>

        <div class="form-label-group">
            <input type="text" class="form-control" name="user" placeholder="Masukan Username" required autofocus>
            <label>Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" name="pass" placeholder="Masukan Password" required>
            <label>Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" name="login">Masuk</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Didah Rosidah 2019</p>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $ambil = $koneksi->query("SELECT * FROM admin WHERE username ='$_POST[user]'
    AND password = '$_POST[pass]'");
        $cocok = $ambil->num_rows;
        if ($cocok == 1) {
            $_SESSION['admin'] = $ambil->fetch_assoc();
            echo "<script>alert('Anda Berhasil Masuk!');</script>";
            echo "<script>location='index.php'</script>";
        } else {
            echo "<script>alert('Login gagal ! Username atau Password salah !');</script>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
        }
    }
    ?>

</body>

</html>