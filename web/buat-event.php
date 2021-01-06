<?php
session_start();
include 'koneksi.php';
include '../format-tanggal.php';
include '../admin/enkripsi.php';

date_default_timezone_set("ASIA/JAKARTA");

if (!isset($_SESSION['akun_user'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
}
// echo "<pre>";
// print_r($_SESSION["akun_user"]);
// echo "</pre>";
?>
				
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body>

  <?php include 'header.php'; ?>

<section>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-sm-9">
				<div class="card text-center">
					<form id="uploadImage" action="upload.php" method="post">
						<div class="form-group">
							<label style="font-size: 30px">Unggah Poster Disini</label><br>
							<label>Direkomendasikan 825 x 450px dan tidak lebih 2Mb</label><br>
							<input type="file" name="uploadFile" id="uploadFile"/>
						</div>
						<div class="form-group">
							<input type="submit" id="uploadSubmit" value="Upload" class="btn btn-info" />
						</div>
					</form>
					<div id="loader-icon" style="display:none;"><img src="img/loader.gif" /></div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="card text-center" style="height: 450px">
					<div id="targetLayer" name="img" style="display:none;"></div>
				</div>
			</div>
			<?php 
			 //echo "<pre>";
			 //print_r($_SESSION["buat"]);
			 //echo "</pre>";
			 ?>
			<div class="col-sm-9">
				<div class="card table-responsive">
					<form method="post">
						<div class="container"><br>
							<h4 class="md-form">Nama Event</h4>
							<input type="text" class="form-control" name="nama_event" placeholder="Isikan Nama Event" required><br>
							<div class="form-group">
							  <h4 class="md-form">Deskripsi Event</h4>
							  <textarea class="form-control" name="deskripsi" rows="3" placeholder="Tulis Deskripsi Event" required></textarea>
							</div>
						</div>
						<table class="table table-hover"><br>
			              <thead>
			                <tr class="md-form">
			                  <th>
			                  	<label class="form-group">Diselenggarakan Oleh</label>
			              		<input type="text" name="selenggara" class="form-control" placeholder="Nama Penyelenggara" required>
			              	  </th>
			              	  <th>
			              	  	<label class="form-group">Tanggal</label>
			              		<input type="date" name="tanggal" class="form-control" required>
			              	  </th>
			              	  <th>
			              	  	<label class="form-group">Lokasi</label>
			              		<input type="text" name="lokasi" class="form-control" placeholder="Isikan Lokasi" required>
			              	  </th>
			                </tr>
			              </thead>
			              <tbody>
			              	<th>
			              		<label class="form-group">Waktu Mulai</label>
			              		<input type="time" name="mulai" class="form-control" required>
			              	</th>
			              	<th>
			              		<label class="form-group">Harga</label>
			              		<input type="number" name="harga" class="form-control" placeholder="Rp." required>
			              	</th>
			              	<th>
			              		<label class="form-group">Kuota</label>
			              		<input type="number" name="kuota" class="form-control" placeholder="Kuota Peserta" required>
			              	</th>
			              </tbody>
			              <tbody>
			              	<th>
			              		<label class="form-group">Waktu Berakhir</label>
			              		<input type="time" name="berakhir" class="form-control" required>
			              	</th>
			              </tbody>
			            </table>
			            <center>
			              <div class="col-md-4"><br>
					        <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit"><i class="fa fa-credit-card"></i> Buat Event</button>
					      </div>
			            </center>
					</form>
				</div>
			</div>
			
			<?php 
			if (isset($_POST['submit'])) 
		      {
		        
		        $id = $_SESSION["buat"];
		        $foto = $_SESSION["foto"];
		        $id_user = $_SESSION["akun_user"]["id_user"];

		        $koneksi->query("INSERT INTO event 
		        	(id_user, nama_event, harga, foto_event, tanggal_start, selenggara, start, berakhir, lokasi, deskripsi_event, stok_event) 
		        	
		        	VALUES ('$id_user', '$_POST[nama_event]', '$_POST[harga]', '$foto', '$_POST[tanggal]', '$_POST[selenggara]', '$_POST[mulai]', '$_POST[berakhir]', '$_POST[lokasi]', '$_POST[deskripsi]', '$_POST[kuota]') ");

		        echo "<div class='alert alert-info'>Data Tersimpan</div>";
		        echo "<meta http-equiv='refresh' content='1;url=riwayat_event.php'>";
		      }
			?>
	</div>
 </div>
</section>

<!-- <section>
  <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-bottom">
    <div class="container">
        <h4>Hebat! 
        	<span style="font-size: 14px">Sedikit lagi kamu akan selesei membuat event</span>
        <br>
        </h4>
        <a href="a.php" class="btn btn-primary"><input type="submit" name="">Buat Event Sekarang</a>
    </div>    
  </nav>
</section> -->

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

  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.form.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
$(document).ready(function(){
	$('#uploadImage').submit(function(event){
		if($('#uploadFile').val())
		{
			event.preventDefault();
			$('#loader-icon').show();
			$('#targetLayer').hide();
			$(this).ajaxSubmit({
				target: '#targetLayer',
				beforeSubmit:function(){
					$('.progress-bar').width('50%');
				},
				uploadProgress: function(event, position, total, percentageComplete)
				{
					$('.progress-bar').animate({
						width: percentageComplete + '%'
					}, {
						duration: 1000
					});
				},
				success:function(){
					$('#loader-icon').hide();
					$('#targetLayer').show();
				},
				resetForm: true
			});
		}
		return false;
	});
});
</script>

</body>

</html>