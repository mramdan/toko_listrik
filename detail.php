<?php
session_start();
include 'header.php';

// mendapatkan id barang
$id_barang = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
$detail = $ambil->fetch_assoc();

?>

<div class="konten">
    <div class="container">
        <div class="row">
            <div class="card shadow">
                <div class="col">
                    <img src="foto_barang/<?php echo $detail['foto_barang']; ?>" alt="" class="img-responsive" width="600">
                </div>
            </div>
            <div class="col">
                <h2><?php echo $detail['nama_barang']; ?></h2>
                <h4>Rp. <?php echo number_format($detail['harga_barang']); ?></h4>
                <h5>Stok : <?php echo $detail['stok']; ?></h5>
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="jumlah" value="1" max="<?php echo $detail['stok']; ?>">
                            <div class="input-group-btn">
                                <button class="btn btn-outline-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST["beli"])) {
                    //mendapatkan jumlah yang di inputkan dari detail
                    $jumlah = $_POST["jumlah"];
                    // memasukan ke keranjang
                    $_SESSION["keranjang"][$id_barang] = $jumlah;

                    echo "<script>alert('Barang sudah di masukan ke keranjang');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
                ?>
                <p><?php echo $detail['deskripsi_barang']; ?></p>
            </div>
        </div>
    </div>
</div>