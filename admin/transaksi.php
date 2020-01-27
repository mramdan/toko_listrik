<?php
include 'header.php';
?>

<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-whit erounded shadow-sm">
    <div class="lh-100">
      <center><h3>Data Transaksi</h3></center>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
    <table class="table table borderd">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM transaksi JOIN pelanggan ON transaksi.
            id_pelanggan=pelanggan.id_pelanggan"); ?>
            <?php while($pecah = $ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_pelanggan'];?></td>
                <td><?php echo $pecah['tanggal_transaksi'];?></td>
                <td><?php echo $pecah['total_pembelian'];?></td>
                <td><?php echo $pecah['status_pembelian']; ?></td>
                <td>
                    <a href="detail.php?halaman=detail&id=<?php echo $pecah['id_transaksi'];?>" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>

        </tbody>
    </table>
</main>

<?php
include 'footer.php'
?>