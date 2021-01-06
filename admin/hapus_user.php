<?php

include 'koneksi.php';

$koneksi->query("DELETE FROM akun_user WHERE akun_user.id_user='$_GET[id]'");

echo "<script>alert('Akun Terhapus');</script>";
echo "<script>location='akun_user.php';</script>";
?>