<?php
include 'header.php';
include '../koneksi.php';
?>

<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-whit erounded shadow-sm">
    <div class="lh-100">
      <center>
        <h3>Data Barang</h3>
      </center>
    </div>
  </div>

  <?php
  $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang = '$_GET[id]'");
  $pecah = $ambil->fetch_assoc();

  ?>

  <div class="card">
    <div class="card-header">
      Edit Data Barang
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_barang'] ?>">
        </div>
        <div class="form-group">
          <label>Harga (Rp)</label>
          <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_barang'] ?>">
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok'] ?>">
        </div>
        <div>
          <div class="form-group">
            <img src="../foto_barang/<?php echo $pecah['foto_barang'] ?>" width="200">
          </div>
          <div class="form-group">
            <label>Ganti Foto</label>
            <input type="file" class="form-control-file" name="foto">
          </div>
          <div class="form-group">
            <label>Deskripsi Barang</label>
            <textarea class="form-control" name="deskripsi" rows="4"><?php echo $pecah['deskripsi_barang']; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button href="barang.php" class="btn btn-secondary">Batal</button>
          <button class="btn btn-primary" name="ubah">ubah</button>
      </form>
      <?php
      if (isset($_POST['ubah'])) {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        // jika foto di ubah
        if (!empty($lokasifoto)) {
          move_uploaded_file($lokasifoto, "../foto_barang/$namafoto");

          $koneksi->query("UPDATE barang SET nama_barang ='$_POST[nama]',
          harga_barang='$_POST[harga]', stok = '$_POST[stok]',
          foto_barang= '$namafoto', deskripsi_barang = '$_POST[deskrpisi]'
          WHERE id_barang = '$_GET[id]'");
        } else {
          $koneksi->query("UPDATE barang SET nama_barang ='$_POST[nama]',
          harga_barang='$_POST[harga]', stok = '$_POST[stok]',
          deskripsi_barang = '$_POST[deskripsi]' WHERE id_barang = '$_GET[id]'");
        }
        echo "<script>alert('Data Barang Berhasil diubah!');</script>";
        echo "<script>location='barang.php'</script>";
      }
      ?>
    </div>
  </div>
</main>
<br>
<?php
include 'footer.php'
?>