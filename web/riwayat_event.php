<?php
session_start();
include 'koneksi.php';
include '../format-tanggal.php';
//include '../url.php';

date_default_timezone_set("ASIA/JAKARTA");

//jika belum login
if (!isset($_SESSION["akun_user"]) OR empty($_SESSION["akun_user"])) 
{
	echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
$id_user = $_SESSION["akun_user"]["id_user"];

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section class="riwayat">
	<div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Foto Event</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Jam Mulai & Berakhir</th>
            <th>Lokasi</th>
            <th>Kuota</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
     	  <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM event 
                WHERE id_user='$id_user'"); ?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
           	<td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_event']; ?></td>     
            <td>
              <img src="../foto event/<?php echo $pecah['foto_event']; ?>" width="200">
            </td> 
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td> 
            <td><?php echo tgl_indonesia($pecah['tanggal_start']); ?><br>
                 
            </td>
            <td><?php echo $pecah['start']; ?> WIB -
                <?php echo $pecah['berakhir']; ?> WIB
            </td>
            <td><?php echo $pecah['lokasi']; ?></td>
            <td><?php echo $pecah['stok_event']; ?></td>
            <td><?php if ($pecah['status']=="Pending"): ?>
              <i class="btn btn-warning"><?php echo $pecah['status'] ?></i>
              <?php else : ?>
              <i class="btn btn-success"><?php echo $pecah['status'] ?></i>
              <?php endif ?>
            </td>
            <td>
             <center>
              <a href="ubahevent.php?id=<?php echo $pecah['id_event']; ?>" class="fas fa-edit" style='font-size:28px;color:blue' title="Edit"></a>
              &#160;
              <a href="hapusevent.php?id=<?php echo $pecah['id_event']; ?>" class="fa fa-trash" style="font-size:28px; color: red" title="Hapus"></a>
              &#160;
              </center>
            </td>
          </tr>
           <?php $nomor++ ?>
           <?php } ?>
         </tbody>
      </table>

    </div>
  </div>
</section>

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