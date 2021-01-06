<?php
session_start();
$koneksi = new mysqli("localhost","root","","tiket");
include('includes/header.php'); 
?>


<div class="container">
<br>
<br>
<br>
<center>
    <h2>SISTEM INFORMASI TICKET </h2>
  </center>

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                <!-- <?php

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                        unset($_SESSION['status']);
                    }
                ?> -->
              </div>

                <form class="user" method="post">

                    <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Username...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>
        <?php
        if (isset($_POST['login']))
        {

          $password = md5($_POST["password"]);

          $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[username]' AND password = '$password'");
          $cocok = $ambil->num_rows; 
          if ($cocok==1) 
          {
            $_SESSION['admin']=$ambil->fetch_assoc();
            echo "<div class='alert alert-info'>Login Sukses</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";            
          }
           else 
           {
              echo "<div class='alert alert-info'>Login Gagal</div>";
              echo "<meta http-equiv='refresh' content='1;url=login.php'>"; 
           } 
        }
        ?>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>