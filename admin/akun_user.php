<?php
include('koneksi.php');
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
<center><h2 class="btn btn-primary">Akun User</h2></center>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <!-- <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Nomor Whatsapp</th> -->
            <th>Aksi</th> 
          </tr>
        </thead>
        <tbody>
     	  <?php $nomor=1; ?>
          <?php $ambil=$koneksi->query("SELECT * FROM akun_user"); ?>
          <?php while($pecah = $ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['username']; ?></td>     
            <td><?php echo $pecah['email_user']; ?></td>
            <td><?php echo $pecah['password_user'] ?></td>
            <!-- <td><?php echo $pecah['nama_user']; ?></td>
            <td><?php echo $pecah['jenis_kelamin']; ?></td>
            <td><?php echo $pecah['alamat_user']; ?></td>
            <td><?php echo $pecah['wa']; ?></td> -->
            <td>
              <!-- <a href="ubah_user.php?id=<?php echo $pecah['id_user']; ?>" class="btn btn-primary">Ubah</a>  --> 
           
            	<a href="hapus_user.php?id=<?php echo $pecah['id_user']; ?>" class="btn btn-danger ml-2">Hapus</a>
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

<?php
include('includes/scripts.php');
//include('includes/footer.php');
?>