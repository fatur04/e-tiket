<?php
include "qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA
 
$tempdir = "temp/"; //<-- Nama Folder file QR Code kita nantinya akan disimpan
if (!file_exists($tempdir))#kalau folder belum ada, maka buat.
    mkdir($tempdir);
 
 
$isi_teks = 'aku'; 
$namafile = "url_saat_ini.png";
$quality = 'H';
$ukuran = 4;
$padding = 2;
 
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
echo "<img src='temp/url_saat_ini.png' />";
?>