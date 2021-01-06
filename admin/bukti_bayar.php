<?php
include 'koneksi.php';
//include 'enkripsi.php';
include '../format-tanggal.php';

date_default_timezone_set("ASIA/JAKARTA");

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

$id_pembelian = $_GET["id"];

//ambil id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran
    JOIN pembelian 
    ON pembayaran.id_pembelian=pembelian.id_pembelian
    JOIN pendaftar
    ON pembelian.id_pembelian=pendaftar.id_pembelian
    JOIN pembelian_event
    ON pembayaran.id_pembelian=pembelian_event.id_pembelian
    WHERE pembelian.id_pembelian='$id_pembelian' ");
$detbay = $ambil->fetch_assoc();
 // echo "<pre>";
 // print_r($detbay);
 // echo "</pre>";
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php
    
    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php',$Write);
    
?>
<script src="jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#getUID").load("UIDContainer.php");
        setInterval(function() {
               $("#getUID").load("UIDContainer.php");
       }, 500);
   });
</script>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h3>Bukti Pembayaran</h3>
        
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
                    <th>Tanggal Pembayaran</th>
                    <td><?php echo tgl_indonesia($detbay["tanggal"]) ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp. <?php echo number_format($detbay["jumlah"]) ?> </td>
                </tr>
            </table>
       
    </div>
    <div class="col-md-8">
        <center><img src="../bukti pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" height="300px"></center>
    </div>
  </div>

    <form method="post">
      <div class="col-md-6">
        <div class="form-group">
            <label>No RFID Lama</label>
            <input type="text" class="form-control" name="resi" readonly value="<?php echo $detbay["rfid"] ?>">
        </div>

        <div class="control-group">
          <label class="control-label">No RFID :</label>
          <div class="controls">
            <textarea name="rfid" id="getUID" class="form-control" placeholder="Tap Kartu RFID" rows="1" cols="123" required></textarea>
            <p class="text-danger">Nomor RFID harus sesuai dengan QRCode</p>
          </div>
        </div>
        
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
                <option value="">Pilih Status</option>
                <option value="E-Ticket Terkirim">E-Ticket Terkirim</option>
                <option value="Lunas">Lunas</option>
                <option value="Batal">Batal</option>
            </select>
        </div>
        <button class="btn btn-primary" name="proses">Proses</button> 
        <!-- <div class="form-group">
          <a href="kirim_tiket.php?id=<?php echo $detbay['id_pembelian']; ?>" class="btn btn-info">Proses</a>
        </div> -->
       </div>
     </form>
     
   <?php 

    //update status pengiriman
     if (isset($_POST["proses"])) 
     {
        $status = $_POST["status"];
        $rfid = $_POST["rfid"];

        #$enkripsi=encryptthis($rfid, $key);
        $spasi = "<br/>";
        $nama_peserta = $detbay["nama_peserta"];

        //echo $nama_id = $nama_peserta . $rfid;
        
        $enkripsi = base64_encode($nama_peserta);
        echo $enkripsi;

        //membuat qrcode
        include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA
         
        $tempdir = "temp/"; //<-- Nama Folder file QR Code kita nantinya akan disimpan
        if (!file_exists($tempdir))#kalau folder belum ada, maka buat.
            mkdir($tempdir);
         
        
        $isi = $enkripsi;
        $namafile = $enkripsi.".png";
        $quality = 'H';
        $ukuran = 8;
        $padding = 2;
         
        QRCode::png($isi,$tempdir.$namafile,$quality,$ukuran,$padding);

        $koneksi->query("UPDATE pembelian SET rfid='$rfid', qrcode='$namafile', 
            status_pembelian='$status' WHERE id_pembelian='$id_pembelian' ");

        $koneksi->query("INSERT INTO absen 
                  (id_event, rfid, nama_absen, jenis_kelamin, alamat_absen, absen_qrcode, wa_absen) 
                    VALUES ('$detbay[id_event]', '$rfid', '$detbay[nama_peserta]', '$detbay[jenis_kelamin]', '$detbay[alamat_peserta]', '$enkripsi', '$detbay[wa_peserta]') ");

//kirim wa
        //echo $nama_peserta = $detbay["nama_peserta"];
        $enkripsi_id = base64_encode($_GET["id"]); 

        $kirim = [
                  "phone" => $detbay["wa_peserta"], // Receivers phone
                  "body" => "Dear : $nama_peserta
Terima Kasih Sudah Membeli E-Tiket kami, Klik link dibawah ini untuk mendapatkan E-Ticket anda. 

Link : 192.168.8.100/e-ticket/admin/e-tiket.php?id=$enkripsi_id", // Message
                 ];
        $json = json_encode($kirim); // Encode data to JSON
        // URL for request POST /message
        $url = 'https://eu124.chat-api.com/instance160902/sendMessage?token=8jibefho7d6a82ls';
        // Make a POST request
        $options = stream_context_create(['http' => [
                 'method'  => 'POST',
                 'header'  => 'Content-type: application/json',
                 'content' => $json
                      ]
                 ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //echo $result;


        //echo "<script>alert('Data Pembelian terupdate');</script>";
        echo "<script>location='pembelian.php';</script>";
     }

    ?> 

</div>
    
</section>


<?php
include('includes/footer.php');
include('includes/scripts.php');

?>