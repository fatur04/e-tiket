<?php
include('koneksi.php');
include '../format-tanggal.php';

date_default_timezone_set("ASIA/JAKARTA");

//session_start();
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
<script type="text/javascript">
  $(function(){
     $('#from').datepicker({
      autoclose: true
    })
     $('#end').datepicker({
      autoclose: true
    })
  })
</script>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Nama Event </label>
                <input type="text" name="nama_event" class="form-control" placeholder="Enter Nama Event">
            </div>
            <div class="form-group">
                <label>Foto Event</label>
                <input type="file" name="foto" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" placeholder="Enter harga">
            </div>
            <div class="form-group">
                <label>Tanggal Mulai Event</label>
                <input type="date" id="datepicker" name="tanggal_start" class="form-control" placeholder="Isikan Dengan Benar">
            </div>
            <div class="form-group">
              <label>Jam Mulai Event</label>
              <input type="time" name="mulai" class="form-control">
            </div>
            <div class="form-group">
                <label>Tanggal Selesei Event</label>
                <input type="date" name="tanggal_end" id="datepicker" class="form-control" placeholder="Isikan Dengan Benar">
            </div>
            <div class="form-group">
                <label>Jam Berakhir Event</label>
                <input type="time" name="berakhir" class="form-control">
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
            </div>
            <div class="form-group">
                <label>Kuota</label>
                <input type="number" name="stok" class="form-control" placeholder="Kuota Peserta">
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea class="form-control" name="deskripsi" rows="10"></textarea>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </div>
      </form> 
      <?php
      if (isset($_POST['save'])) 
      {
        $nama = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasi, "../foto event/".$nama);
        $koneksi->query("INSERT INTO event
          (nama_event,harga,foto_event,deskripsi_event, stok_event, tanggal_start, tanggal_end, start, berakhir, lokasi)
          VALUES('$_POST[nama_event]','$_POST[harga]','$nama','$_POST[deskripsi]','$_POST[stok]', '$_POST[tanggal_start]', '$_POST[tanggal_end]', '$_POST[mulai]', '$_POST[berakhir]', '$_POST[lokasi]')");

        echo "<div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=event.php'>";
      }
      ?>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Tambahkan Event 
            </button>
    </h6>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Jam Mulai & Berakhir</th>
            <th>Lokasi</th>
            <th>Kuota</th>
            <th>Status</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
     	  <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM event"); ?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
           	<td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_event']; ?></td>     
            <!-- <td>
              <img src="../foto event/<?php echo $pecah['foto_event']; ?>" width="100">
            </td> 
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td> -->
            <td><?php echo tgl_indonesia($pecah['tanggal_start']); ?><br>
                 
            </td>
            <td><?php echo $pecah['start']; ?> WIB -
                <?php echo $pecah['berakhir']; ?> WIB
            </td>
            <td><?php echo $pecah['lokasi']; ?></td>
            <td><?php echo $pecah['stok_event']; ?></td>
            <td><?php if ($pecah['status']=="Pending"): ?>
              <i class="btn btn-warning"><?php echo $pecah['status'] ?></i>
              <?php else : ?>
              <i class="btn btn-success"><?php echo $pecah['status'] ?></i>
              <?php endif ?>
            </td>
            <td>
             <center>
              <a href="ubahevent.php?id=<?php echo $pecah['id_event']; ?>" class="fas fa-edit" style='font-size:25px;color:blue' title="Edit"></a>
              &#160;
              <a href="hapusevent.php?id=<?php echo $pecah['id_event']; ?>" class="fa fa-trash" style="font-size:25px; color: red" title="Hapus"></a>
              &#160;
              <a href="lihat.php?id=<?php echo $pecah['id_event']; ?>" class="fa fa-check-square-o" style="font-size:25px; color: green" title="Lihat"></a>
             </center>
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