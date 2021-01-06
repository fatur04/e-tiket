<?php

include 'koneksi.php';
include '../format-tanggal.php';
date_default_timezone_set("ASIA/JAKARTA");

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
include('includes/header.php'); 
include('includes/navbar.php'); 

$ambil = $koneksi->query("SELECT * FROM absen 
                          JOIN event
                          ON absen.id_event=event.id_event 
                          WHERE  event.id_event='$_GET[id]' ");
$jopok = $ambil->fetch_assoc();

?>

<div class="container-fluid">
<center><h2>Tabel Absen Event <?php echo $jopok['nama_event'] ?></h2></center>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Absen Masuk</th>
            <th>Absen Pulang</th>
          </tr>
        </thead>
        <tbody>

     	<?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM absen 
                          JOIN event
                          ON absen.id_event=event.id_event 
                          WHERE event.id_event='$_GET[id]' "); ?>

        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <?php 
        // echo "<pre>";
		// print_r($pecah);
		// echo "</pre>";
         ?>
        
		    <tr>
          <td><?php echo $nomor; ?></td>
          <td><?php echo $pecah['nama_absen']; ?></td>
          <td><?php if ($pecah['status_absen']=="Belum Absen"): ?>
              <i class="btn btn-warning"><?php echo $pecah['status_absen'] ?></i>
              <?php else : ?>
              <i class="btn btn-success"><?php echo $pecah['status_absen'] ?></i>
              <?php endif ?>
          </td>
          <td><?php echo tgl_indonesia($pecah['tanggal_sekarang']) ?></td>
          <td><?php echo $pecah['absen_masuk'] ?></td>
          <td><?php echo $pecah['absen_pulang'] ?></td>
          <!-- <td>
            <?php 
            if ($pecah['status_absen']=="Belum Absen"): ?>
            <button class="btn btn-warning">Belum Absen</button>
            <?php else : ?>
            <button class="btn btn-success">Sudah Absen</button>
            <?php endif ?><br>
          </td> -->
        </tr>

        <?php $nomor++ ?>
        <?php } ?>
                        
         </tbody>
      </table>

    </div>
  </div>
</div>

</div>

 <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>