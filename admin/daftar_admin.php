<?php
include 'koneksi.php';
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
    <center><h2>Daftar Admin</h2></center>
    <div class="card shadow mb-4">

   <form  method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confir_password" class="form-control" placeholder="Confirm Password">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="register" class="btn btn-primary">Save</button>
        </div>
      </form>
      <?php 
      if (isset($_POST["register"])) {
        
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $confir = md5($_POST["confir_password"]);

        $ambil = $koneksi->query("INSERT INTO admin (username, password, confir_password)
                                VALUES ('$username', '$password', '$confir') ");

        echo "<script>alert('Pembuatan Akun Berhasil');</script>";
        echo "<script>location='index.php';</script>";

      }
       ?>

</div>
</div>

<?php
include('includes/scripts.php');
//include('includes/footer.php');
?>