<?php

include 'koneksi.php';

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
include('includes/header.php'); 
include('includes/navbar.php'); 

$ambil = $koneksi->query("SELECT * FROM event WHERE id_event='$_GET[id]' ");
$jopok = $ambil->fetch_assoc();

?>

<div class="container-fluid">
<center><h2>Tabel Pendaftar Event <?php echo $jopok['nama_event'] ?></h2></center>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th width="12%">Nama Lengkap</th>
            <th width="12%">No RFID</th>
            <th width="13%">Jenis Kelamin</th>
            <th width="10%">Alamat</th>
            <th width="5%">No Whatsapp</th>
          </tr>
        </thead>
        <tbody>

     	<?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian 
                    JOIN pendaftar 
                    ON pembelian.id_pembelian=pendaftar.id_pembelian
                    JOIN pembelian_event
                    ON pembelian.id_pembelian=pembelian_event.id_pembelian
                    WHERE id_event='$_GET[id]' "); ?>

        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <?php 
        // echo "<pre>";
		// print_r($pecah);
		// echo "</pre>";
         ?>
        <?php 
        if ($pecah['status_pembelian']=="E-Ticket Terkirim"): ?>
		
		<tr>
          <td><?php echo $nomor; ?></td>
          <td><?php echo $pecah['nama_peserta']; ?></td>
          <td><?php echo $pecah['rfid'] ?></td>
          <td><?php echo $pecah['jenis_kelamin'] ?></td>
          <td><?php echo $pecah['alamat_peserta'] ?></td>
          <td><?php echo $pecah['wa_peserta'] ?></td>
        </tr>
        <?php endif ?>

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