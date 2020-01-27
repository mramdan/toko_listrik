<?php
include 'header.php';
include '../koneksi.php';
?>

<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-whit erounded shadow-sm">
    <div class="lh-100">
      <center><h3>Data Barang</h3></center>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
    <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Tambah Data Barang</button>
    <br>
    <br>
    <table class="table table borderd">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok Barang</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM barang"); ?>
            <?php while($pecah = $ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_barang'];?></td>
                <td><?php echo $pecah['harga_barang'];?></td>
                <td><?php echo $pecah['stok'];?></td>
                <td>
                  <img src="../foto_barang/<?php echo $pecah['foto_barang'];?>" width="100">
                </td>
                <td>
                    <a href="hapusbarang.php?halaman=hapusbarangk&id=<?php echo $pecah['id_barang']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    <a href="editbarang.php?halaman=editbarang&id=<?php echo $pecah['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Barang Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" class="form-control" name="harga" required>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" class="form-control" name="stok"required>
        </div>
        <div class="form-group">
            <label>Deskripsi Barang</label>
            <textarea class="form-control" name="deskripsi" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control-file" name="foto">
        </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="save">Simpan</button>
        </form>
      <?php
        if (isset($_POST['save']))
        {
            $nama = $_FILES['foto']['name'];
            $lokasi = $_FILES['foto']['tmp_name'];
            move_uploaded_file($lokasi, "../foto_barang/".$nama);
            $koneksi->query("INSERT INTO barang
                (nama_barang,harga_barang,stok,foto_barang,deskripsi_barang)
                VALUES('$_POST[nama]','$_POST[harga]','$_POST[stok]','$nama','$_POST[deskripsi]')");
             echo "<script>alert('Data Barang Berhasil dimasukan!');</script>";
             echo "<meta http-equiv='refresh' content='1;url=barang.php'>";
          }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
include 'footer.php'
?>