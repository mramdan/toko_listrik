<?php
session_start();
include 'header.php';

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
}
?>

<div class="container">
    <div class="card shadow">
        <h5 class="card-header">Keranjang Belanja</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Barang</b></td>
                        <td><b>Harga</b></td>
                        <td><b>Jumlah</b></td>
                        <td><b>Total</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
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
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $total; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="card shadow">
        <h5 class="card-header">Informasi Pengiriman</h5>
        <div class="card-body">
            <form method="post">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip01">Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip02">No Telpon</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['no_telpon'] ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip02">Ongkir</label>
                        <select type="text" class="form-control" name="id_ongkir">
                            <option value="">Pilih Ongkos Kirim</option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while ($ongkir = $ambil->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $ongkir["id_ongkir"] ?>">
                                    <?php echo $ongkir['nama_kota'] ?> -
                                    Rp. <?php echo number_format($ongkir['tarif']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman" rows="3" placeholder="Masukan alamat lengkap pegiriman (termasuk kode pos)"></textarea>
                </div>
                <button class="btn btn-primary" name="checkout">Checkout</button>
            </form>
            <?php
            if (isset($_POST["checkout"])) {
                $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
                $id_ongkir = $_POST["id_ongkir"];
                $tanggal_pembelian = date("Y-m-d");
                $alamatpengiriman = $_POST['alamat_pengiriman'];

                $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir ='$id_ongkir'");
                $arrayongkir = $ambil->fetch_assoc();
                $kotapengiriman = $arrayongkir['nama_kota'];
                $tarif = $arrayongkir['tarif'];

                $total_pembelian = $totalbelanja + $tarif;

                //1. menyimpan data ke tabel transaksi
                $koneksi->query("INSERT INTO transaksi (id_pelanggan, id_ongkir, tanggal_transaksi, total_pembelian, kota_pengiriman,tarif,alamat_pengiriman)
                VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$kotapengiriman','$tarif','$alamatpengiriman')");

                //mendapatkan id_transkasi barusan terjadi
                $id_pembelian_barusan = $koneksi->insert_id;

                foreach ($_SESSION["keranjang"] as $id_barang => $jumlah) {

                    //mendapatkan data barang berdasarkan id_barang
                    $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang ='$id_barang'");
                    $perbarang = $ambil->fetch_assoc();

                    $nama = $perbarang['nama_barang'];
                    $harga = $perbarang['harga_barang'];

                    $subharga = $perbarang['harga_barang'] * $jumlah;

                    $koneksi->query("INSERT INTO pembelian_barang (id_transaksi,id_barang,nama,harga,subharga,jumlah)
                    VALUES ('$id_pembelian_barusan','$id_barang','$nama','$harga','$subharga','$jumlah')");

                    //syntax update stok barang
                    $koneksi->query("UPDATE barang SET stok = stok - $jumlah
                    WHERE id_barang='$id_barang'");
                }

                //mengkosongkan keranjang belanja
                unset($_SESSION["keranjang"]);

                //jika berhasil di alihkan ke halaman nota pembelian yang barusan
                echo "<script>alert('Pembelian Sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>
        </div>
    </div>
</div>
<br>
<br>
<p class="mt-5 mb-3 text-muted text-center">&copy; Toko Umar 2019</p>