<?php
    require 'connect_rfid.php';
    include 'koneksi.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM absen 
			where rfid = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
	
// echo "<pre>";
// print_r($data);
// echo "</pre>";

	$msg = null;
	if (null==$data['nama_absen']) {
		$msg = "Kartu RFID Tidak Terdaftar !!!";
		$data['rfid']=$id;
		$data['nama_absen']="--------";
		$data['jenis_kelamin']="--------";
		$data['alamat_absen']="--------";
		$data['wa_absen']="--------";

	} else {
		$msg = null;
	}
?>
 
	<style>
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
	</style>

	<body>		

		<div>
			<form method="post">
				<table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#10a0c5"><font  color="#FFFFFF">
						<b>User Data</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left" name="update"><?php echo $data['rfid'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Nama</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['nama_absen'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Jenis Kelamin</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['jenis_kelamin'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Alamat</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['alamat_absen'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Nomor Whatsapp</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['wa_absen'];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
			<?php 
			$id = $_GET["id"];
			$ambil = $koneksi->query("SELECT * FROM absen
				WHERE rfid = '$id' ");
			$detpem = $ambil->fetch_assoc();
			// echo "<pre>";
			// print_r($detpem);
			// echo "</pre>";
			 ?>
			<?php 
			if (isset($_GET["id"])) {
			
				$koneksi->query("UPDATE absen SET absen_pulang = NOW() 
					WHERE rfid='$id' ");
             
				echo "<script>alert('Sudah Absen');</script>";
				echo "<script>location='riwayat.php';</script>";	
			}	
			
			 ?>
		</div>
		<br> 	
		<p style="color:red;" align="center"><?php echo $msg;?></p>
		<center><button class="btn btn-info" onClick="window.location.reload()">Scan Ulang</button></center>
	</body>
</html>
