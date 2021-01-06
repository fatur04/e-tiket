<?php
session_start();
include 'koneksi.php';
//include '../url.php';

if (!isset($_SESSION['akun_user'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
}

if (!isset($_SESSION["keranjang"])) 
{
    //echo "<script>alert('pembelian kosong');</script>";
    echo "<script>location='../index.php';</script>";
}

// echo "<pre>";
// print_r($_SESSION["keranjang"]);
// echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>


<section>
  <div class="container">
    <form method="post">
    <div class="row">
      <div class="col-md-7"> 

          <h4 class="mb-3">Informasi Personal</h4>
           <div class="row">
             <div class="col-md-6 mb-3">
               <label for="firstName">Username</label>
               <input type="text" class="form-control" readonly value="<?php echo($_SESSION["akun_user"]["username"]) ?>" placeholder="" name="username" required>
             </div>
             <div class="col-md-6 mb-3">
                <label for="firstName">Email</label>
                <input type="text" class="form-control" value="<?php echo($_SESSION["akun_user"]["email_user"]) ?>" placeholder="" name="email_user" required>
              </div> 
            </div>

          <div class="row">
            <div class="col-md-6 mb-3">
               <label for="firstName">Nama Lengkap</label>
               <input type="text" class="form-control" placeholder="Nama Lengkap..." name="nama" required>
               <div class="invalid-feedback">
                     Masukan Nama Lengkap.
                </div>
             </div>
             <div class="col-md-6 mb-3">
                <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <div class="invalid-feedback">
                      Masukan Jenis Kelamin.
                </div>
              </div>
            </div>                           

            <div class="mb-3">
              <label for="address">Alamat Lengkap</label>
                 <input type="text" class="form-control" placeholder="Masukan Alamat..." name="alamat_user" required>
                 <div class="invalid-feedback">
                         Alamat Belum Diisi.
                 </div>
             </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputZip">Kode Negara</label>
                <input type="text" class="form-control" readonly="" value="+62" name="kode">
              </div>

              <div class="form-group col-md-10">
               <label for="address">Nomor Whatsapp</label>
               <input type="text" class="form-control" placeholder="Wajib nomor whatsapp aktif" name="wa" value="<?php echo($_SESSION["akun_user"]["wa_user"]) ?>" required>
                <div class="invalid-feedback">
                      Jangan Lupa Nomor Whatsapp Yang Masih Aktif Boss...
                </div>
              </div>              
            </div> 
             
                            
              <hr class="mb-4">
                       
      </div>

      <div class="col-md-5">
        <div class="uk-grid-margin uk-first-column">
          <div class="light uk-h3"><H3>Pembelian Kamu</H3></div>
            <table class="table table-hover"><br>
              <thead>
                <tr>
                  <th class="uk-width-medium"><span class="uk-text-bold uk-text-capitalize">Tiket</span></th>
                  <th class="uk-table-shrink"><span class="uk-text-bold uk-text-capitalize">Jumlah</span></th>
                  <th class="uk-width-small"><span class="uk-text-bold uk-text-capitalize">Harga</span></th>
                </tr>
              </thead>
              <tbody>
              <?php $nomor=1; ?>
              <?php $total=0; ?>
              <?php foreach ($_SESSION["keranjang"] as $id_event => $jumlah): ?>
              <?php 
              //$id_event = decrypt($enkripsi_id);

              $ambil = $koneksi->query("SELECT * FROM event
                  WHERE id_event='$id_event'");

              $pecah = $ambil->fetch_assoc();
              $subharga = $jumlah;
              
              //$total+=$subharga;
              ?>     
              <?php endforeach ?>  
              <!-- cek query -->
              <!-- <pre><?php print_r($pecah) ?></pre> -->
                <tr>
                  <th><?php echo $pecah["nama_event"]; ?></th>
                  <th>1</th>
                  <th>Rp. <?php echo number_format($subharga); ?></th>   
                </tr>                  
    
                <tr class="total border-top">              
                  <th colspan="2">Total Pembayaran</th>                  
                  <th>Rp. <?php echo number_format($subharga); ?></th>
                </tr>
                
              </tbody>                        
            </table>
            <div class="gray uk-text-small uk-margin">
              <p class="text-danger">
                Pastikan untuk cek kembali tiket yang akan kamu beli. 
                Penambahan nominal dibelakang sebagai kode unik pembayaran.
              </p>        
            </div>
        </div>
      </div>
      <div class="col-md-7">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="bayar"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</button>
      </div>
    </form>
    <?php 
      if (isset($_POST["bayar"])) 
      {
        $id_user = $_SESSION["akun_user"]["id_user"];
        $nama = $_POST["nama"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $email = $_POST["email_user"];
        $alamat = $_POST["alamat_user"];
        $telepon = $_POST["kode"].$_POST["wa"];

        //query insert ke tabel user
        // $koneksi->query("UPDATE akun_user SET nama_user = '$nama',
        //           jenis_kelamin = '$jenis_kelamin',
        //           alamat_user = '$alamat',
        //           wa = '$telepon' WHERE id_user = '$id_user'");
        
       
        $tanggal_pembelian = date("Y-m-d");
        $total;

        //menyimpan data ke tabel pembelian
        $koneksi->query("INSERT INTO pembelian 
          (id_peserta, tanggal_pembelian, tarif_event, rfid, qrcode)
          VALUES ('$id_user','$tanggal_pembelian','$subharga', '', '') ");

        //mendapatkan id pembelian barusan terjadi
        $id_pembelian_barusan = $koneksi->insert_id;

        $koneksi->query("INSERT INTO pendaftar
                  (id_pembelian, id_user, nama_peserta, jenis_kelamin, email_peserta, alamat_peserta, wa_peserta)
                  VALUES ('$id_pembelian_barusan', '$id_user', '$nama','$jenis_kelamin', '$email', '$alamat', '$telepon') ");

        //perulangan
        foreach ($_SESSION["keranjang"] as $id_event => $jumlah) 
        {
          
          //$id_event = decrypt($enkripsi_id);
          
          //mendapatkan data produk berdasarkan id produk
          $ambil=$koneksi->query("SELECT * FROM event WHERE id_event='$id_event'");
          $perproduk = $ambil->fetch_assoc();

          $nama_event = $perproduk['nama_event'];
          $total;
        
          $koneksi->query("INSERT INTO pembelian_event (id_pembelian_event, id_pembelian,id_event,nama,total)
              VALUES ('NULL','$id_pembelian_barusan','$id_event','$nama_event','$subharga')");

          //skrip update stok
          $koneksi->query("UPDATE event SET stok_event = stok_event - 1 WHERE id_event='$id_event'");


//kirim email

require '../PHPMailer/src/PHPMailer.php' ;
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

$email = $_POST["email_user"];
$body= "
Dear : $nama <br/><br/>

Terima Kasih telah pesan tiket dari e-tiketpolines.my.id. Pembayaran via transfer Virtual Acoount. Untuk cara pembayaran bisa ikuti panduan dibawah ini : <br/><br/>

<table>
  <thead>
    <tr>
      <td>Nomor Virtual Account</td> &#160;&#160;&#160;&#160;
      <td>08788007799</td>
    </tr>
    <tr>
      <td>Akun Pemilik Bank</td> &#160;&#160;&#160;&#160;
      <td>PT. Patur </td>
    </tr>
    <tr>
      <td>Jumlah Transfer</td> &#160;&#160;&#160;&#160;
      <td>Rp. $subharga </td>
    </tr>
  </thead>
</table><br/>

Silahkan login dan kirim bukti pembayaranmu dimenu riwayat pembelian. <br/>
Klik https://e-tiketpolines.my.id/web/login.php <br/><br/>

Salam, <br/>
Tim E-Ticket Polines <br/> ";

$mail =  new PHPMailer\PHPMailer1\PHPMailer();
    $mail->IsSMTP(); 
    $mail->IsHTML(true);
    $mail->SMTPAuth   = true; 
    $mail->Host     = "mail.e-tiketpolines.my.id";
    $mail->Port     = 465;
    $mail->SMTPSecure   = "ssl";
    $mail->Username   = "admin@e-tiketpolines.my.id"; //username SMTP
    $mail->Password   = "jAg42UF)Nnje";   //password SMTP
  $mail->From       = "admin@e-tiketpolines.my.id"; //sender email
  $mail->FromName   = "Admin E-Ticket";      //sender name
  $mail->AddAddress("$email");//recipient: email and name
  $mail->Subject    =  "Pembayaran";
  $mail->Body       =  "$body";
 

    //$mail->AddAttachment("/cpanel.png","filesaya");
  if($mail->Send()){
     echo "Email sent successfully";
  }else{
   echo "Email failed to send";
  }



//kirim wa

          $kirim = [
              'phone' => $telepon, // Receivers phone
              'body' => 'Selamat Atas Pembelian tiket kamu, silahkan login dan selesaikan pembayaran. 

Link : 192.168.8.100/e-ticket/login.php', // Message
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
          //if ($url== true){ echo "Terkirim";}
           //else { echo "Tidak Terkirim" ; } 

          echo "<script>alert('Pembelian Sukses');</script>";
          echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
      }


     ?>
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