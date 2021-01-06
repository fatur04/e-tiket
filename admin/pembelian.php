<?php
include('koneksi.php');
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

?>

<div class="container-fluid">
<center><h2>Tabel Pembelian</h2></center>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th width="12%">Pembeli Tiket</th>
            <th width="12%">Nama Event</th>
            <th width="13%">Tanggal Pembelian</th>
            <th width="10%">Status Pembelian</th>
            <th width="5%">No RFID</th>
            <th width="12%">Total Harga</th>
            <th width="32%">Aksi</th>
          </tr>
        </thead>
        <tbody>

     	  <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian 
                    JOIN pendaftar 
                    ON pembelian.id_pembelian=pendaftar.id_pembelian
                    JOIN pembelian_event
                    ON pembelian.id_pembelian=pembelian_event.id_pembelian"); ?>
        <?php while($pecah = $ambil->fetch_assoc()){ ?>
          
        <tr>
          <td><?php echo $nomor; ?></td>
          <td><?php echo $pecah['nama_peserta']; ?></td>
          <td><?php echo $pecah['nama']; ?></td>
          <td><?php echo tgl_indonesia($pecah['tanggal_pembelian']); ?></td>
          <td>
           <?php 

            if ($pecah['status_pembelian']=="Pending"): ?>
            <button class="btn btn-warning">Pending</button>
            <?php else : ?>
            <button class="btn btn-success">Lunas</button>
            <?php endif ?><br>
               
          </td>
          <td><button class="btn btn-default"><?php echo $pecah['rfid']; ?></button>
              <?php if ($pecah['status_pembelian']=="E-Ticket Terkirim"): ?>
              <button class="btn btn-default">Terkirim</button>
              <?php endif ?>
          </td>
          <td>Rp. <?php echo number_format($pecah['total']); ?></td>
          <td>
            <a href="detail.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info ml-2">Detail</a>  
            <?php

            //bukti pembayaran muncul otomatis 
            if ($pecah['status_pembelian']!=="Pending"): ?>
            <a href="bukti_bayar.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success ml-2">Bukti Pembayaran</a>
            <?php endif ?>
          </td>
        </tr>
        <?php $nomor++ ?>
        <?php } ?>
                        
         </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



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