<?php
session_start();
include 'header.php';
?>

<!-- Koneten-->
<div class="container">
    <h1>Barang Terbaru</h1>
    <br>
    <div class="row">
        <?php $ambil = $koneksi->query("SELECT*FROM barang"); ?>
        <?php while ($barang = $ambil->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card shadow" style="width 20rem;">
                    <img class="card-img-top" src="foto_barang/<?php echo $barang['foto_barang']; ?>" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $barang['nama_barang']; ?></h5>
                        <h5>Rp. <?php echo number_format($barang['harga_barang']); ?></h5>
                        <a href="beli.php?id=<?php echo $barang['id_barang']; ?>" class="btn btn-primary">Beli</a>
                        <a href="detail.php?id=<?php echo $barang['id_barang']; ?>" class="btn btn-light">Detail</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>

</html>