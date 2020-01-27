<?php
session_start();
include 'header.php';

?>
<div class="container">
    <div class="card shadow">
        <h5 class="card-header">Riwayat Pembelian <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h5>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Tanggal</b></td>
                        <td><b>Status</b></td>
                        <td><b>Total</b></td>
                        <td><b>Opsi</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                        <!-- menampilkan id_pelanggan-->
                        <?php 
                        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                        $ambil = $koneksi->query("SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan'");
                        while ($pecah = $ambil->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["tanggal_transaksi"]; ?></td>
                            <td><?php echo $pecah["status_pembelian"]; ?></td>
                            <td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
                            <td>
                                <a href="nota.php?id=<?php echo $pecah["id_transaksi"]; ?>" class="btn btn-info">Nota</a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>