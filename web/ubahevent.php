<?php
include('koneksi.php');
// if (!isset($_SESSION['admin'])) 
// {
//     echo "<script>alert('anda harus login');</script>";
//     echo "<script>location='login.php';</script>";
//     header('location:login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="row justify-content-md-center">
 <div class="card shadow col-sm-9">
  <h2>Ubah Event</h2>
  <?php
  $ambil=$koneksi->query("SELECT * FROM event WHERE id_event='$_GET[id]'");
  $pecah=$ambil->fetch_assoc();
  ?>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Event</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_event'] ?>">
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga'] ?>">
      </div>
      <div class="form-group">
        <img src="../foto event/<?php echo $pecah['foto_event']; ?>" width="400">
      </div>
      <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
      </div>
      <div class="form-group">
        <label>Tanggal Mulai Event</label>
        <input type="date" name="tanggal_start" class="form-control" placeholder="Isikan Dengan Benar" value="<?php echo $pecah['tanggal_start'] ?>">
      </div>
      <div class="form-group">
        <label>Jam Mulai Event</label>
        <input type="time" name="mulai" class="form-control" placeholder="Isikan Dengan Benar" value="<?php echo $pecah['start'] ?>">
      </div>
      <div class="form-group">
        <label>Jam Berakhir Event</label>
        <input type="time" name="berakhir" class="form-control" placeholder="Isikan Dengan Benar" value="<?php echo $pecah['berakhir'] ?>">
      </div>
      <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" value="<?php echo $pecah['lokasi'] ?>">
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"><?php echo $pecah['deskripsi_event']; ?></textarea>
      </div>
      <div class="form-group">
        <label>Kuota Peserta</label>
        <input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_event'] ?>">
      </div>
      <button class="btn btn-primary" name="ubah">Ubah</button>
      <a href="event.php" class="btn btn-warning">Batal</a>
    </form>

<?php
if (isset($_POST['ubah'])) 
{
  $namafoto = $_FILES['foto']['name'];
  $lokasifoto = $_FILES['foto']['tmp_name'];
  
  if (!empty($lokasifoto)) 
  {
    move_uploaded_file($lokasifoto, "../foto event/$namafoto");

    $koneksi->query("UPDATE event SET nama_event='$_POST[nama]',
      harga='$_POST[harga]',
      tanggal_start='$_POST[tanggal_start]',
      start='$_POST[mulai]',
      berakhir='$_POST[berakhir]',
      lokasi='$_POST[lokasi]',
      foto_event='$namafoto',
      deskripsi_event='$_POST[deskripsi]',
      stok_event='$_POST[stok]'
      WHERE id_event='$_GET[id]'");
  }
  else
  {
    $koneksi->query("UPDATE event SET nama_event='$_POST[nama]',
      harga='$_POST[harga]',
      tanggal_start='$_POST[tanggal_start]',
      start='$_POST[mulai]',
      berakhir='$_POST[berakhir]',
      lokasi='$_POST[lokasi]',
      deskripsi_event='$_POST[deskripsi]',
      stok_event='$_POST[stok]'
      WHERE id_event='$_GET[id]'");
  }
  echo "<script>alert('event telah diubah');</script>";
  echo "<script>location='riwayat_event.php';</script>";
}
?>

  </div>
</div>

</div>
<!-- /.container-fluid -->

</footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>