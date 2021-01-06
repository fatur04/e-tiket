<?php
session_start();
include 'koneksi.php';

//jika belum login
if (!isset($_SESSION["akun_user"]) OR empty($_SESSION["akun_user"])) 
 {
 	echo "<script>alert('Silahkan login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
 }

//mendapatkan id pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian 
    WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yg beli
$id_pelanggan_beli = $detpem["id_peserta"];
//mendapatkan id_pelanggan yg login
$id_pelanggan_login = $_SESSION["akun_user"]["id_user"];

if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
     echo "<script>alert('ojok nakal...TUMAN angel temen tuturanmu..');</script>";
     echo "<script>location='riwayat.php';</script>";
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

  <section>
    <div class="container">
    <h2>Konfirmasi Pembayaran</h2>
    <p></p>
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info">
            Kirim Bukti Pembayaran anda disini.
            Total tagihan Anda <strong>Rp. <?php echo number_format($detpem["tarif_event"]) ?></strong>
          </div>
       </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="form-group">
            <label>Bank</label>
            <input type="text" class="form-control" name="bank" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="1" required>
            <p class="text-danger">Inputkan Sesuai dengan Total Tagihan tanpa titik dan koma (contoh 5010)</p>
        </div>
        <div class="form-group">
            <label>Foto Bukti</label>
            <input type="file" class="form-control" name="bukti" required>
            <p class="text-danger">Foto Bukti JPG Maksimal 2MB</p>
        </div>
        <button class="btn btn-primary" name="kirim">Kirim</button>
    </form>
</div>
<?php 
if (isset($_POST["kirim"])) 
{
    //upload dulu foto bukti
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "../bukti pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    $koneksi->query("INSERT INTO pembayaran
        (id_pembelian,nama,bank,jumlah,tanggal,bukti)
        VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

    //update status pending menjadi Lunas
    $koneksi->query("UPDATE pembelian SET status_pembelian='LUNAS' 
        WHERE id_pembelian='$idpem' ");


    echo "<script>alert('Terima Kasih Sudah Melakukan Pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
}
 ?>

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