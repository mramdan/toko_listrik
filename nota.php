<?php
session_start();
include 'header.php';
?>

<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-whit erounded shadow-sm">
        <div class="lh-100">
            <center>
                <h3>Detail Transaksi</h3>
            </center>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <?php
        $ambil = $koneksi->query("SELECT * FROM transaksi JOIN pelanggan
        ON transaksi.id_pelanggan=pelanggan.id_pelanggan
        WHERE transaksi.id_transaksi = '$_GET[id]'");
        $detail = $ambil->fetch_assoc();
        ?>



        <div class="row">
            <div class="col-md-4">
                <h4>Transaksi Pembelian</h4>
                <strong>Kode Transaksi: <?php echo $detail['id_transaksi']; ?></strong>
                <p>
                    <?php echo $detail['tanggal_transaksi']; ?><br>
                    Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
                </p>
            </div>
            <div class="col-md-4">
                <h4>Pelanggan</h4>
                <strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
                <p>
                    <?php echo $detail['no_telpon']; ?><br>
                    <?php echo $detail['email']; ?><br>
                </p>
            </div>
            <div class="col-md-4">
                <h4>Pengiriman</h4>
                <strong><?php echo $detail['kota_pengiriman']; ?></strong><br>
                Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
                Alamat: <?php echo $detail['alamat_pengiriman']; ?>
            </div>
        </div>
        <table class="table table borderd">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM pembelian_barang WHERE id_transaksi='$_GET[id]'"); ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                        <td><?php echo $pecah['jumlah']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Ongkos Kirim</th>
                    <th>Rp. <?php echo number_format($detail['tarif']); ?></th>
                </tr>
                <tr>
                    <th colspan="4">Total Bayar</th>
                    <th>Rp. <?php echo number_format($detail['total_pembelian']); ?></th>
                </tr>
            </tfoot>
        </table>
        <div class="alert alert-primary" role="alert">
            Silahkan melakukan pembayaran <strong> Rp. <?php echo number_format($detail['total_pembelian']); ?></strong> ke rekening<br>
            <strong>BANK BECEKAN 0987-9868798-8798 AN. Didah Rosidah</strong>
        </div>
        <div class="alert alert-warning" role="alert">
         Bukti nota transfer silahkan kirim ke no WhatsApp <a href="#" class="alert-link">0876636736</a>. Untuk konfirmasi pembayaran dan jika sudah di konfirmasi barang akan segera di krim ke alamat rumah anda.
        </div>
</main>