<?php
include 'header.php';
?>

<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-whit erounded shadow-sm">
    <div class="lh-100">
      <center><h3>Data Pelanggan</h3></center>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
    <table class="table table borderd">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
            <?php while($pecah = $ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_pelanggan'];?></td>
                <td><?php echo $pecah['email'];?></td>
                <td><?php echo $pecah['alamat'];?></td>
                <td><?php echo $pecah['no_telpon'];?></td>
                <td>
                    <a href="hapuspelanggan.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger btn-sm">Hapus</a>
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