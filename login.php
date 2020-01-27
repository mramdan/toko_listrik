<?php
session_start();
include 'header.php';
?>

<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="width 40rem;">
                <div class="card">
                    <h5 class="card-header">Login Pelanggan</h5>
                    <div class="card-body">
                        <form class="form-signin" method="post">
                            <div class="form-label-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                                <br>
                            </div>
                            <div class="form-label-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <br>
                            </div>
                             <button class="btn btn-primary" name="login">Masuk</button>
                             </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email' AND password='$password'");
            //cek ketersediaan akun
            $akuncocok = $ambil->num_rows;
            //jika ada
            if ($akuncocok == 1) {
                //anda berhasil login
                $akun = $ambil->fetch_assoc();
                $_SESSION['pelanggan'] = $akun;
                echo "<script>alert('Login Suksess');</script>";


                // jika sudah belanja
                if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                {
                    echo "<script>location='checkout.php';</script>";
                }else
                {
                    echo "<script>location='index.php';</script>";
                }
            } else {
                //gagal login
                echo "<script>alert('login gagal, periksa akun anda');</script>";
                echo "<script>location='login.php';</script>";
            }
        }
        ?>
        <div class="col">
            <div class="card" style="width 40rem;">
                <div class="card">
                    <h5 class="card-header">Registrasi Pelanggan</h5>
                    <div class="card-body">
                    <h6>Belum punya akun ? Silahkakan Registarasi dulu</h6>
                        <form class="form-signin" method="post">
                            <div class="form-label-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                                <br>
                            </div>
                            <div class="form-label-group">
                                <input type="text" class="form-control" name="nama_pelanggan" placeholder="Nama Lengkap" required autofocus>
                                <br>
                            </div>
                            <div class="form-label-group">
                                <textarea class="form-control" name="alamat" placeholder="Alamat" required autofocus rows="4"></textarea>
                                <br>
                            </div>
                            <div class="form-label-group">
                                <input type="text" class="form-control" name="no_telpon" placeholder="No Telpon" required autofocus>
                                <br>
                            </div>
                            <div class="form-label-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <br>
                            </div>
                            <button class="btn btn-primary" name="daftar">Daftar</button>
                        </form>

                        <!-- //syntax registrasi -->
                        <?php 
                        if (isset($_POST["daftar"])) 
                        {
                            $email = $_POST["email"];
                            $namapelanggan = $_POST ["nama_pelanggan"];
                            $alamat = $_POST["alamat"];
                            $notelpon = $_POST["no_telpon"];
                            $password = $_POST["password"];

                            $koneksi->query("INSERT INTO pelanggan (email, nama_pelanggan, alamat, no_telpon, password)
                            VALUES ('$email','$namapelanggan','$alamat','$notelpon','$password')");

                            echo "<script>alert('Pendaftaran berhasil, Silahkan Login untuk melanjutkan !');</script>";
                            echo "<script>location='login.php';</script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
