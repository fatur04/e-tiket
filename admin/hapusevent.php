<?php

include 'koneksi.php';

$ambil = $koneksi->query("SELECT * FROM event WHERE id_event='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoevent = $pecah['foto_event'];
if (file_exists("foto event/$fotoevent")) 
{
	unlink("foto event/$fotoevent");
}

$koneksi->query("DELETE FROM event WHERE id_event='$_GET[id]'");

echo "<script>alert('Event Terhapus');</script>";
echo "<script>location='event.php';</script>";
?>