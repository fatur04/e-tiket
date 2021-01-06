<?php 
session_start();
include 'koneksi.php';
//include '../url.php';

if (!isset($_SESSION['akun_user'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
}

//deskripsi
//$id = decrypt($_GET["id"]);
$id =$_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembelian
	JOIN pendaftar
    ON pembelian.id_peserta=pendaftar.id_user 
	WHERE pembelian.id_pembelian='$id'");
$detail = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yg beli
// $idpelangganbeli = $detail["id_user"];

// //mendapatkan id pelanggan login
// $idpelangganlogin = $_SESSION["akun_user"]["id_user"];

// if ($idpelangganbeli!==$idpelangganlogin) 
// {
// 	echo "<script>alert('Hayoo Ngapain...');</script>";
//     echo "<script>location='riwayat.php';</script>";
//     exit();
// }

// echo "<pre>";
// print_r($detail);
// echo "</pre>";

 ?>
<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>
<p></p>
<br><br>

<section>
	<div class="container">
		<div class="row">
		<div class="col-md-7">
			<h1>Terima Kasih Atas Pesanan Kamu</h1>
			
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info">				
						Kamu melakukan pembayaran via ATM Transfer. Silakan menyelesaikan pembayaran						
					</div>
				</div>
			</div>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<td>Nomor Virtual Account</td>
						<td>08788007799</td>
					</tr>
					<tr>
						<td>Akun Pemilik Bank</td>
						<td>PT. Patur </td>
					</tr>
					<tr>
						<td>Jumlah Transfer</td>
						<td>Rp. <?php echo number_format($detail['tarif_event']); ?></td>
					</tr>
				</thead>
			</table><br>
			
		</div>

		<div class="col-md-5">
			<p>Panduan Pembayaran ATM</p>
			<ol>
				<li>Catat 16 digit nomor virtual account & nominal pembayaran Anda.</li>
				<li>Gunakan ATM yang memiliki jaringan ATM Bersama/Prima/Alto untuk menyelesaikan pembayaran</li>
				<li>Masukkan PIN Anda.</li>
				<li>Di menu utama pilih ‘Others’.</li>
				<li>Pilih ‘Transfer’ lalu pilih ‘other bank account’.</li>
				<li>Masukkan kode bank permata ‘013’ diikuti dengan 16 digit nomor virtual account.</li>
				<li>Masukkan nominal pembayaran lalu pilih ‘Correct’.</li>
				<li>Pastikan nominal pembayaran & nomor virtual account sudah benar terisi, lalu pilih ‘Correct’.</li>
				<li>Pembayaran Anda dengan Virtual Account selesai.</li>
			</ol>
		</div>

		<div class="col-md-7">
			<a href="pembayaran.php?id=<?php echo $id ?>" class="btn btn-primary">Pembayaran</a>
		</div>
	</div>
</div>
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