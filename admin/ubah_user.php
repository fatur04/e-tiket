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

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <h2>Ubah Event</h2>
  <?php
  $ambil=$koneksi->query("SELECT * FROM akun_user WHERE id_user='$_GET[id]'");
  $pecah=$ambil->fetch_assoc();
  ?>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Username</label>
        <input type="username" class="form-control" name="username" value="<?php echo $pecah['username'] ?>">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $pecah['email_user'] ?>">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Isikan Dengan Benar" value="<?php echo $pecah['password_user'] ?>">
      </div>
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_user" class="form-control" placeholder="Isikan Dengan Benar" value="<?php echo $pecah['nama_user'] ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <div class="invalid-feedback">
              Masukan Jenis Kelamin.
        </div>
      </div>
      <div class="form-group">
        <label>Alamat Lengkap</label>
        <input type="text" name="alamat_user" class="form-control" placeholder="Lokasi" value="<?php echo $pecah['alamat_user'] ?>">
      </div>
      <div class="form-group">
        <label>Nomor Whatsapp</label>
        <input type="number" class="form-control" name="wa" value="<?php echo $pecah['wa'] ?>">
      </div>
      <button class="btn btn-primary" name="ubah">Ubah</button>
      <a href="akun_user.php" class="btn btn-warning">Batal</a>
    </form>

<?php
if (isset($_POST['ubah'])) 
{
  
    $koneksi->query("UPDATE akun_user SET username='$_POST[username]',
      username='$_POST[username]',
      email_user='$_POST[email]',
      password_user='$_POST[password]',
      nama_user='$_POST[nama_user]',
      jenis_kelamin='$_POST[jenis_kelamin]',
      alamat_user='$_POST[alamat_user]',
      wa='$_POST[wa]'
      WHERE akun_user.id_user='$_GET[id]'");
 
  echo "<script>alert('Akun telah diubah');</script>";
  echo "<script>location='akun_user.php';</script>";
}
?>

  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>