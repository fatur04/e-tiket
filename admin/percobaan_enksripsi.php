<?php 
include('includes/header.php'); 
include 'koneksi.php';

$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

function encryptthis($data, $key){
	$encryption_key = base64_decode($key); 
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); 
	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv); 
	return base64_encode($encrypted . '::' . $iv);
 }
 function decryptthis($data, $key) { 
	$encryption_key = base64_decode($key); 
	list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null); 
	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv); 
} 

 ?>

<!-- <div class="container">
	<br><br><br><br>
	<div class="col-md-6">
		<form method="post">
	 	<div class="form-group">
	 		<label for="foo">Enter Text</label>
	 		<input type="text" class="form-control" name="foo">
	 	</div>
	 	<button type="submit" name="submit" class="btn btn-success btn-lg">Submit</button>
	 </form>

	</div>
</div> -->

<section>
	<div class="container">
	<br><br><br><br>
	<div class="col-md-12">
		<form method="post">
	 	<div class="form-group">
	 		<label for="foo">Nama</label>
	 		<input type="text" class="form-control" name="name">
	 	</div>
	 	<div class="form-group">
	 		<label for="foo">Password</label>
	 		<input type="text" class="form-control" name="password">
	 	</div>
	 	<button type="submit" name="submit" class="btn btn-success btn-lg">Submit</button><br><br>
	 </form>
 <?php 
if(isset($_POST['submit'])){ 
		$name=$_POST['name'];
		$name=encryptthis($name, $key);
		$password=$_POST['password']; 
		$password=encryptthis($password, $key);

		$deskripsi_name=decryptthis($name, $key);
		$deskripsi_password=decryptthis($password, $key);

		echo '<p>Nama : '.$name.' </p>';
		echo '<p>Password : '.$password.' </p>';

		echo '<p>Nama : '.$deskripsi_name.' </p>';
		echo '<p>Password : '.$deskripsi_password.' </p>';

		$koneksi->query("INSERT INTO enkripsi (nama, password)
				VALUES ('$name', '$password')");

		echo "<div class='alert alert-success'>Data Tersimpan</div>";

}

 ?>		
	</div>
</div>
</section>

 

<?php include('includes/scripts.php'); ?>