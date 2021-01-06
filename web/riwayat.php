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

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section class="riwayat">
	<div class="container">
		<h3>Riwayat Pembelian <?php echo $_SESSION["akun_user"]["username"] ?></h3>
		<div class="table-responsive">
		  <table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$nomor=1;
				//mendapatkan id pelanggan
				$id_user = $_SESSION["akun_user"]['id_user'];

				$ambil = $koneksi->query("SELECT * FROM pembelian 
					WHERE id_peserta='$id_user'");
				while ($pecah = $ambil->fetch_assoc()) {
					

				 ?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo tgl_indonesia($pecah["tanggal_pembelian"]) ?></td>
					<td>
						<?php echo $pecah["status_pembelian"] ?>		
					</td>

					<td>Rp. <?php echo number_format($pecah["tarif_event"]) ?></td>
					<td>

					<?php //enkripsi 
						//$id_pembelian = encrypt($pecah["id_pembelian"]) ?>

					<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Cara Pembayaran</a>

					<?php if ($pecah['status_pembelian']=="Pending"): ?>
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-warning">Input Pembayaran
						</a>
					<?php else: ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-success">
								Bukti Pembayaran
						</a>
					<?php endif ?>

					 <?php
					   $enkripsi_id = base64_encode($pecah["id_pembelian"]);

				       if ($pecah['status_pembelian']=="E-Ticket Terkirim"): ?>
				       <a href="../admin/e-tiket.php?id=<?php echo $enkripsi_id; ?>" class="btn btn-info ml-2">Cetak E-Ticket</a>
				       <?php endif ?>

					</td>
					
				</tr>
				<?php $nomor++; ?>
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