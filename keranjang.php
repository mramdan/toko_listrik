<?php
session_start();
include 'header.php';

if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kososng, Silahkan belanja terlebih dahulu !');</script>";
    echo "<script>location='index.php';</script>";
}
?>

<div class="container">
    <h2>Keranjang Belanja</h2>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Barang</b></td>
                        <td><b>Harga</b></td>
                        <td><b>Jumlah</b></td>
                        <td><b>Total</b></td>
                        <td><b>Aksi</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) : ?>
                        <!-- menampilkan barang berdasarkan id_barang-->
                        <?php $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang = '$id_barang'");
                            $pecah = $ambil->fetch_assoc();
                            $total = $pecah["harga_barang"] * $jumlah; ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["nama_barang"]; ?></td>
                            <td>Rp. <?php echo number_format($pecah["harga_barang"]); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($total); ?></td>
                            <td>
                                <a href="hapuskeranjang.php?id=<?php echo $id_barang ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <center>
                <a href="index.php" class="btn btn-success">Lanjutkan Belanja</a>
                <a href="checkout.php" class="btn btn-primary">Checkout</a></center>
        </div>
    </div>

</div>