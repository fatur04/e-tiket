<?php
session_start();
include 'koneksi.php';
include '../format-tanggal.php';
//include '../url.php';

date_default_timezone_set("ASIA/JAKARTA");

//$id_pembelian = decrypt($_GET["id"]);
$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran
    LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
    WHERE pembelian.id_pembelian='$id_pembelian' ");
$detbay = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($_SESSION['akun_user']);
// echo "</pre>";

//jika blm ada data pembayaran
if (empty($detbay)) 
{
    echo "<script>alert('belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

//jika data pelanggan yg bayar tdk sesuai login
if ($_SESSION["akun_user"]['id_user'] !== $detbay["id_peserta"]) 
{
    echo "<script>alert('EROOORRR');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section>
	<div class="container">
        <h3>Lihat Pembayaran</h3>
        <div class="row">
        <div class="col-md-5">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td><?php echo $detbay["nama"] ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?php echo $detbay["bank"] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo tgl_indonesia($detbay["tanggal"]) ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp. <?php echo number_format($detbay["jumlah"]) ?> </td>
                </tr>
            </table>
        </div>
        <div class="col-md-7">
            <img src="../bukti pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" height="300px">
        </div>
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