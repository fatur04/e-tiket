<?php
session_start();

//session_destroy();
unset($_SESSION["akun_user"]);
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='../index.php';</script>";
?>