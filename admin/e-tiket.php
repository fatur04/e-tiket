<?php 
include('koneksi.php');
include '../format-tanggal.php';
include '../url.php';

date_default_timezone_set("ASIA/JAKARTA");


//$id_pembelian = decrypt($_GET["id"]);

$id_pembelian = base64_decode($_GET["id"]);
 
 ?>
 <?php $ambil=$koneksi->query("SELECT * FROM  pembelian
                JOIN pembelian_event
                ON pembelian.id_pembelian=pembelian_event.id_pembelian 
                JOIN event
                ON pembelian_event.id_event=event.id_event
                JOIN
                pendaftar
                ON pembelian.id_peserta=pendaftar.id_user
                WHERE pembelian_event.id_pembelian='$id_pembelian'"); ?>
 <?php $pecah=$ambil->fetch_assoc(); ?>

 
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>E-Voucher &mdash; </title>
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="../web/assets/img/favicon.png" rel="icon">
  <link href="../web/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../web/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../web/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../web/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../web/assets/vendor/owl.carousel/../web/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../web/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../web/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../web/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">

</head>
	<body>
		<div class="site-header">
			<div class="site-header__logo">
				<em>E-TICKETKU</em>
			</div>
			<div class="site-header__action">
				<button onCLick="window.print();set_voucher_print();" id="button-print" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M128 224h256v224H128zM127.5 224.5h256v224h-256zM111.5 64.5h288v32h-288zM432.5 112.5h-352c-17.645 0-33 12.842-33 30.31V301.2c0 17.468 15.355 33.3 33 33.3h31v-126h288v126h33c17.645 0 31-15.832 31-33.3V142.81c0-17.468-13.355-30.31-31-30.31z"/></svg> Print E-Voucher</button>
			</div>
		</div>
		<div class="content_template">
	<div class="evoucher-wrapper">
	<div class="evoucher">
		<table>
		<tr>
			<td style="width:75%;text-transform:uppercase;font-weight:700;padding:6px 12px;font-size:14px;">
			<div class="editable__">
			Ticket Type : <span style="color:#FF3A2D;"><?php echo $pecah["nama"]; ?></span> (Rp. <?php echo number_format($pecah["harga"]); ?>) 1 Ticket for 1 Person  
			</div>
			</td>
		</tr>
		</table>
	<table>
	<tr>
	<td rowspan="2" style="width:75%;padding:10px 0px;vertical-align:middle;">
	<div style="position:relative;">
	<img src="../foto event/<?php echo $pecah['foto_event']; ?>" class="image_banner" alt="" style="display:block;max-width:500px;height:280px;margin:auto;padding:0px 10px;">
	
	</div>
	</div>
	</td>
		<td style="text-align:center;vertical-align:middle;padding:0px;">
			<div style="position:relative;">
				<b>QRCode</b><br>
				<img src="temp/<?php echo $pecah['qrcode']; ?>" class="image_logo" style="width: 200px;height: 200px;">
				<span style="display:block;margin:0;line-height:1.2;font-size:12px;"><br><b>TICKET 1 of 1</b></span>
			</div>
		</td>
	</tr>
		<tr>
			
		</tr>
	<tr>
		<td style="text-align:center;text-transform:uppercase;font-weight:700;font-size:13px;whitespace:nowrap;padding:6px 12px;">
			<div class="editable__">
			<?php echo $pecah["nama"]; ?> 2020
			<br>
			<?php echo tgl_indonesia($pecah["tanggal_start"]) ?> <?php echo $pecah["start"] ?> - <?php echo $pecah["berakhir"] ?>
			<br>
			Politeknik Negri Semarang, Jl. Prof. Soedarto, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275, Indonesia
			<br>
			</div>
		</td>
		<td style="text-align:center;line-height:1.2;padding:8px 12px;font-size:14px;">
		 <div class="editable__">
			<b>
			 <br><?php echo $pecah["nama_peserta"] ?>
			</b>
			<br><?php echo tgl_indonesia($pecah["tanggal_pembelian"]) ?>
			<br>Ref: Online
			<br>
		 </div>
		</td>
	</tr>
	<tr>
	<td colspan="2">
	<h2 style="margin:0 0;font-size:18px;color:#FF3A2D;text-transform:uppercase;text-align: center;" class="editable__">Terms & Condition</h2>
	<table class="toc">
	<tr>
	<td style="width:50%">
	<div class="editable__">
	<ul>
	<li>
	<b>Proof of ID is a requirement for every ticket purchased</b>
	<br>
	<i>Wajib menunjukkan kartu identitas untuk setiap pembelian tiket</i>
	</li>
 <li>
	<b>E-voucher can be exchanged at Politeknik Negri Semarang on 20 Nov 2019 07:00 &ndash; 18:00</b>
	<br>
	<i>E-voucher ini dapat ditukarkan dengan tiket asli pada 20 Nov 2019 07:00 &ndash; 18:00 di Politeknik Negri Semarang</i>
	</li>
	<li>
 <b>Tickets are non-refundable</b>
	<br>
	<i>Tiket yang sudah dibeli tidak dapat dikembalikan</i>
	</li>
	<li>
	<b>We are NOT responsible for the lost of this e-voucher</b>
	<br>
	<i>Kami tidak bertanggung jawab atas kehilangan e-voucher ini</i>
	</li>
	</ul>
	</div>
	</td>
	<td style="width:50%">
	<div class="editable__">
	<ul>
	<li>
	<b>NO WEAPON & NO DRUGS</b>
	<br>
	<i>DILARANG MEMBAWA SENJATA ATAU OBAT-OBATAN</i>
	</li>
	<li>
	<b>We will have every right to refuse and/or discharge entry for ticket holders that does not meet the Term & Condition</b>
	<br>
	<i>Penyelenggara berhak untuk tidak memberikan izin untuk masuk ke dalam tempat acara apabila syarat-syarat & ketentuan tidak dipenuhi</i>
	</li>
	</ul>
	</div>
 </td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<table>	
 		<tr>
 			<td colspan="3" style="text-align:center;white-space:nowrap;font-size:12px;font-weight:700;width:33.33333%;"> Powered by <a href="http://www.E-ticketku.com">E-Ticket.com</a>
 			</td>
 		</tr>
	</table>
	</div>
	</div>
	</div>
  <script src="../web/assets/vendor/jquery/jquery.min.js"></script>
  <script src="../web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../web/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../web/assets/vendor/php-email-form/validate.js"></script>
  <script src="../web/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../web/assets/vendor/counterup/counterup.min.js"></script>
  <script src="../web/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../web/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../web/assets/vendor/venobox/venobox.min.js"></script>
  <script src="../web/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../web/assets/js/main.js"></script>	
</body>
</html>