<?php
session_start();
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section>
  <br><br><br>
   <center>
    <h2>Login Pelanggan </h2>
  </center>

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
          <form method="post" class="form-horizontal">

              <div class="form-group">
                <label class="control-label">Username</label>
                  <input type="text" class="form-control" name="username" required>
              </div>
              <div class="form-group">
                <label class="control-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                  <input type="text" class="form-control" name="password" required>
              </div>
              <div class="form-group">
                  <button class="btn btn-primary" name="daftar">Daftar</button>
              </div>
            </form>
      
            <?php 

            if (isset($_POST["daftar"])) 
            {

              $username = $_POST["username"];
              $email = $_POST["email"];
              $password = $_POST["password"];
              // $alamat = $_POST["alamat"];
              // $telepon = $_POST["telepon"];

              //cek apakah email sudah digunakan
             $ambil = $koneksi->query("SELECT * FROM akun_user
                WHERE email_user='$email'");
              $cocok = $ambil->num_rows;
              if ($cocok==1) 
              {
                echo "<script>alert('email sudah terdaftar');</script>";
                echo "<script>location='daftar.php';</script>";
              }
              else
              {
                //query insert ke tabel user
                $koneksi->query("INSERT INTO akun_user
                  (email_user,password_user,username)
                  VALUES('$email','$password','$username') ");

                
                echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
                echo "<script>location='login_user.php';</script>";
              }
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