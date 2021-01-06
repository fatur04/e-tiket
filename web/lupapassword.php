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
    <h2>Lupa Password </h2>
  </center>

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
          <form method="post" class="form-horizontal">

              <div class="form-group">
                <label class="control-label">Whastapp</label>
                  <input type="text" class="form-control" name="wa" required placeholder="Awali +62">
                  <p class="text-danger">Pastikan Whatsapp yang anda daftarkan aktif</p>
              </div>
              <div class="form-group">
                  <button class="btn btn-primary" name="kirim">Kirim Verifikasi</button>
              </div>
            </form>
      
            <?php 

            if (isset($_POST["kirim"])) 
            {

              $wa = $_POST["wa"];
              // $alamat = $_POST["alamat"];
              // $telepon = $_POST["telepon"];
              $ambil = $koneksi->query("SELECT * FROM akun_user 
                WHERE wa_user='$wa' ");
              
              //akun yg terambil
              $cocok = $ambil->num_rows; 

              //jika akun cocok, maka diloginkan
              if ($cocok==1) 
              {
                $akun = $ambil->fetch_assoc();
              //simpan di session akun_user
              $_SESSION["akun_user"] = $akun;
              echo $wabaru = $_SESSION["akun_user"]["wa_user"];
              echo $id = $_SESSION["akun_user"]["id_user"];

// echo "<pre>";
// print_r($_SESSION["akun_user"]);
// echo "</pre>";

//kirim wa

          $kirim = [
              "phone" => $wabaru, // Receivers phone
              "body" => "Silahkan klik tautan dibawah ini untuk ganti password anda.

Link : 192.168.1.28/e-ticket/web/settingpassword.php?id=$id", // Message
          ];
          $json = json_encode($kirim); // Encode data to JSON
          // URL for request POST /message
          $url = 'https://eu102.chat-api.com/instance162506/sendMessage?token=mac0bksnz4e1aghr';
          // Make a POST request
          $options = stream_context_create(['http' => [
                  'method'  => 'POST',
                  'header'  => 'Content-type: application/json',
                  'content' => $json
              ]
          ]);
          // Send a request
          $result = file_get_contents($url, false, $options);
          echo $result;
          
          echo "<script>alert('Silahkan cek Whatsapp anda');</script>";
          echo "<script>location='login.php';</script>";

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