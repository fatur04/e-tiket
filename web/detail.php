<?php
session_start();
include 'koneksi.php';
include '../format-tanggal.php';
//include '../admin/enkripsi.php';
//include '../url.php';

date_default_timezone_set("ASIA/JAKARTA");

$id_event = $_GET["id"];
//$deskripsi_name=decryptthis($_GET["id"], $key);
//$id_event = decrypt($_GET["id"]);
//echo $deskripsi_name;

$ambil = $koneksi->query("SELECT * FROM event WHERE id_event='$id_event'");
$pecah = $ambil->fetch_assoc();	

// if (!isset($_SESSION['akun_user'])) 
// {
//     echo "<script>alert('anda harus login');</script>";
//     echo "<script>location='login_user.php';</script>";
// }
$ambil=$koneksi->query("SELECT * FROM pembelian_event order by id_pembelian desc limit 1 ");
$perproduk = $ambil->fetch_assoc();
$id = $perproduk["id_pembelian"];

// $jopok=$koneksi->query("SELECT * FROM pembelian_event where id_event LIKE $id_event ");
// $oy = $jopok->fetch_assoc();
// echo $oy["id_event"];

?>
				
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section>
	<div class="container">
	 <div class="row">

      <div class="col-md-7">   	
		<div class="card">
		  	<center><img class="card-img-top" img src="../foto event/<?php echo $pecah['foto_event'] ?>" alt="Card image" style="width:100%"></center>
		    <div class="card-body">
	      		<h4 class="card-title"><?php echo $pecah["nama_event"]; ?></h4>
	      <table class="table table-hover table-responsive">
	      	<thead>
	      		<tr>
	      			<th>Diselenggarakan</th>
	      			<th>Tanggal dan Waktu</th>
	      			<th>Lokasi</th>
	      		</tr>
	      	</thead>
	      	<tbody>
	      		<tr>
	      			<th><?php echo $pecah["nama_event"]; ?></th>
	      			<th><?php echo tgl_indonesia($pecah["tanggal_start"]); ?> <br>
	      			<?php echo $pecah["start"]; ?> - <?php echo $pecah["berakhir"]; ?> WIB</th>
	      			<th><?php echo $pecah["lokasi"]; ?></th>
	      		</tr>
	      	</tbody>	      	
	    </table>
	    <b><p>Deskripsi Event</p></b>
		    <h6><?php echo $pecah["deskripsi_event"]; ?></h6><br>
	      </div>
	    </div>
      </div>

	  <div class="col-md-5">
	  	<form method="post">
      	<p><h4>Harga Tiket</h4></p>
      	  
      	  <div class="form-control" value="<?php echo number_format($pecah['harga']) ?>" name="jumlah" >
      	  	Rp. <?php echo number_format($pecah['harga']) ?>
      	  </div>

			<!-- <select class="form-control" name="jumlah" id="jumlah" required>
				<option value="">Pilih Kategori</option>
			    <option value="1">
					Reguler 1 -
					Rp. <?php echo number_format($pecah['harga']) ?>
				</option>
				<option value="2">
					Reguler 2 -
					Rp. <?php echo number_format($pecah['harga']*2) ?>
				</option>
				<option value="3">
					Reguler 3 -
					Rp. <?php echo number_format($pecah['harga']*3) ?>
				</option>
			</select> -->

		<br>
		<button class="btn btn-primary" name="beli">Beli</button> 
		<!-- <a href="keranjang.php?id=<?php echo $id_event ?>" class="btn btn-primary">Beli</a>-->	
    	<p></p>
    	<b><p>SYARAT dan KETENTUAN</p></b>
		    <ul>
		    	<li>Kamu bisa menikmatinya dengan klik "Watch Here" yang berada di E-Voucher sesuai dengan jadwal perform yang disebutkan.</li>
		    	<li>Sebagian hasil penjualan tiket akan didonasikan untuk mendukung penanganan wabah virus corona. Kamu bisa membeli tiket jenis apapun dengan jumlah lebih dari 1 untuk memberikan apresiasi lebih sekaligus berdonasi di event ini.</li>
		    	<li>E-Voucher ini adalah bukti bahwa kamu telah berkontribusi dalam memberikan donasi untuk meredam dampak corona sekaligus memberikan apresiasi lebih ke musisi & kru di tengah pandemi ini.</li>
		    </ul>
		   </form>
		   
		   <?php 
			if (isset($_POST["beli"])) 
	        {
	          $harga = $pecah['harga'];
	          $jumlah = $harga+10+(1*$id);

	          //mendapatkan jumlah inputan
	          //$jumlah = $pecah['harga'];
	          //$enkripsi_id = encrypt($id_event); 
	          
	          //masukan ke keranjang beli
	          $_SESSION["keranjang"][$id_event] = $jumlah;

	          //echo "<script>alert('produk masuk keranjang bosss...');</script>";
	          echo "<script>location='form.php';</script>";
	        }
           ?>
			
    	</div>	
	 </div>
	</div>
</section>



<!-- <section>
  <form method="post">
	<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-bottom">
	  <div class="container">
		  	<h2 name="nama">Pembelian Tiket : 
		  		<?php echo $pecah["nama_event"]; ?>
		  	</h2>
		  	<button class="btn btn-primary" name="beli">Beli Tiket</button>		
	  </div>	  
	</nav>
	</form>	  
</section>
 -->
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