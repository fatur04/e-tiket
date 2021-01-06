<?php 
include 'web/koneksi.php';
header('Content-Type: application/json; charset=utf8');

$ambil = $koneksi->query("SELECT * FROM absen");

$output = array();
while ($perproduk = $ambil->fetch_assoc()) {
	$output[] = $perproduk;

}
echo $json = json_encode($output, JSON_PRETTY_PRINT);

//file_put_contents("data.json", $json);

 ?>