<?php
session_start();
include 'koneksi.php';
include '../url.php';

echo $id = $_GET["id"];
              
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section>
  <br><br><br>
   <center>
    <h2>Ganti Password Anda </h2>
  </center>

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
          <form method="post" class="form-horizontal">

              <div class="form-group">
                <label class="control-label">Password Baru</label>
                  <input type="text" class="form-control" name="password" required>
              </div>
              <div class="form-group">
                  <button class="btn btn-primary" name="ganti">Ganti Password</button>
              </div>
            </form>
      
            <?php 

            if (isset($_POST["ganti"])) 
            {

              $password = encrypt($_POST["password"]);
              // $alamat = $_POST["alamat"];
              // $telepon = $_POST["telepon"];

              //cek apakah email sudah digunakan
            $koneksi->query("UPDATE akun_user SET password_user ='$password'
                           WHERE id_user='$id' "); 

                echo "<script>alert('Sukses Ganti Password, Silahkan Login');</script>";
                echo "<script>location='login.php';</script>";
              
            }
             ?>
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