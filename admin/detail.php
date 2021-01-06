<?php
include 'koneksi.php';
include 'enkripsi.php';
include '../url.php';

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

$id_pembelian = $_GET["id"];

include('includes/header.php'); 
include('includes/navbar.php'); 
?>
 
<?php $ambil=$koneksi->query("SELECT * FROM  pembelian
                JOIN pembelian_event
                ON pembelian.id_pembelian=pembelian_event.id_pembelian 
                JOIN event
                ON pembelian_event.id_event=event.id_event
                JOIN
                pendaftar
                ON pembelian.id_peserta=pendaftar.id_user
                JOIN
                absen
                ON pembelian.rfid=absen.rfid
                WHERE pembelian_event.id_pembelian='$_GET[id]' "); ?>
 <?php $pecah=$ambil->fetch_assoc(); ?>
 
  <!-- <pre><?php print_r($pecah) ?></pre>   -->

<div class="container-fluid">
<center><h2>Detail Pembelian</h2></center>
<div class="card shadow mb-4">
  
  <div class="card-body">
  <h4>Akun Pembeli Tiket</h4>
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peserta</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Nomor Whatsapp</th>
          </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_peserta']; ?></td>     
            <td><?php echo $pecah['email_peserta']; ?></td>
            <td><?php echo $pecah['jenis_kelamin']; ?></td>
            <td><?php echo $pecah['alamat_peserta']; ?></td>
            <td><?php echo $pecah['wa_peserta']; ?></td>
          </tr>
         <?php $nomor++ ?>
        </tbody>
      </table>
    </div>
  </div>

 </div>

</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor RFID</th>
              <th>Encrypt RFID</th>
              <th>Descrypt RFID</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor=1; ?>
            <?php 
            //deskripsi
            //$deskripsi_name=decryptthis($pecah['absen_qrcode'], $key);
            $absen_qrcode = $pecah['absen_qrcode'];
            $deskripsi = base64_decode($absen_qrcode);
             ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah['rfid']; ?></td>
              <td><?php echo $pecah['absen_qrcode']; ?></td>
              <td><?php echo $deskripsi; ?></td>
            </tr>
            <?php $nomor++ ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">

    <!-- Cek Array -->
    <!-- <pre><?php print_r($pecah) ?> </pre> -->
   <center>
   	   <h2>Event Tiket yang Dibeli</h2>
   	   <?php 
       if ($pecah['status_pembelian']=="Pending"): ?>
       <button class="btn btn-warning">Pending</button>
       <?php else : ?>
       <button class="btn btn-success">Lunas</button>
       <?php endif ?>
       
       <?php 
       //deskripsi
       //$id = encrypt($_GET["id"]);
       $enkripsi_id = base64_encode($id_pembelian);

       if ($pecah['status_pembelian']=="E-Ticket Terkirim"): ?>
       <a href="e-tiket.php?id=<?php echo $enkripsi_id; ?>" class="btn btn-info ml-2">Cetak E-Ticket</a>
       <?php endif ?>
       
   </center><br>
   
   <div class="card shadow mb-4">
    
  <div class="card-body">
	 <div class="row">
      
    <div class="col-lg-7">   	
		<div class="card">
		  	<center><img class="card-img-top" img src="../foto event/<?php echo $pecah['foto_event'] ?>" alt="Card image" style="width:100%"></center>
		    <div class="card-body">
	      		<h4 class="card-title"><?php echo $pecah["nama_event"]; ?></h4>
	      <table class="table table-hover table-responsive">
	      	<thead>
	      		<tr>
	      			<th>Diselenggarakan Oleh </th>
	      			<th>Tanggal dan Waktu</th>
	      			<th>Lokasi</th>
	      		</tr>
	      	</thead>
	      	<tbody>
	      		<tr>
	      			<th><?php echo $pecah["nama_event"]; ?></th>
	      			<th><?php echo $pecah["tanggal_start"]; ?> <br>
	      			<?php echo $pecah["start"]; ?> sampai <?php echo $pecah["berakhir"]; ?></th>
	      			<th><?php echo $pecah["lokasi"]; ?></th>
	      		</tr>
	      	</tbody>	      	
	    </table>
	    <b><p>Deskripsi Event</p></b>
		    <h6><?php echo $pecah["deskripsi_event"]; ?></h6><br>
	      </div>
	    </div>
      </div>

	  <div class="col-lg-5">
	  	
    	<b><p>SYARAT dan KETENTUAN</p></b>
		    <ul>
		    	<li>Kamu bisa menikmatinya dengan klik "Watch Here" yang berada di E-Voucher sesuai dengan jadwal perform yang disebutkan.</li>
		    	<li>Sebagian hasil penjualan tiket akan didonasikan untuk mendukung penanganan wabah virus corona. Kamu bisa membeli tiket jenis apapun dengan jumlah lebih dari 1 untuk memberikan apresiasi lebih sekaligus berdonasi di event ini.</li>
		    	<li>E-Voucher ini adalah bukti bahwa kamu telah berkontribusi dalam memberikan donasi untuk meredam dampak corona sekaligus memberikan apresiasi lebih ke musisi & kru di tengah pandemi ini.</li>
		    </ul>
			
    	</div>	
	 </div>
	</div>
  </div>
</div>


  <?php
// include('includes/footer.php');
include('includes/scripts.php');

?>