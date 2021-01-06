<?php 
include 'web/koneksi.php';

$url = 'https://e-tiketpolines.my.id/api.php';
$json = file_get_contents($url);
$data = json_decode($json, TRUE);

foreach ($data as $user) {
    echo $id_absen = $user['id_absen']; 
    echo $id_event = $user['id_event'];
    echo $rfid = $user['rfid'];
    echo $nama_absen = $user['nama_absen'];
    echo $jenis_kelamin = $user['jenis_kelamin'];
    echo $alamat_absen = $user['alamat_absen'];
    echo $status_absen = $user['status_absen'];
    echo $absen_qrcode = $user['absen_qrcode'];
    echo $wa_absen = $user['wa_absen'];
    echo $tanggal_sekarang = $user['tanggal_sekarang'];
    echo $absen_masuk = $user['absen_masuk'];
    echo $absen_pulang = $user['absen_pulang'];

    $koneksi->query("INSERT INTO absen 
                  (id_event, rfid, nama_absen, jenis_kelamin, alamat_absen, status_absen, absen_qrcode, wa_absen, tanggal_sekarang, absen_masuk, absen_pulang) 
                    VALUES ('$id_event', '$rfid', '$nama_absen', '$jenis_kelamin', '$alamat_absen', '$status_absen','$absen_qrcode', '$wa_absen', '$tanggal_sekarang', '$absen_masuk', '$absen_pulang') ");

}

 ?>
 

 
 
 
 