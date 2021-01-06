<?php
session_start();
include 'koneksi.php';
include '../admin/enkripsi.php';
include '../url.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required />
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />
            Tidak Bisa login? <a href="lupapassword.php">Lupa Password</a> 
           <?php
        if (isset($_POST["login"]))
        {

          $email = $_POST["email"];
          $password = encrypt($_POST["password"]);
          //$password=decryptthis($_GET["id"], $key);
          
          $ambil = $koneksi->query("SELECT * FROM akun_user 
            WHERE email_user='$email' AND password_user = '$password'");
          
          //akun yg terambil
          $cocok = $ambil->num_rows; 

          //jika akun cocok, maka diloginkan
          if ($cocok==1) 
          {
            //sukses login
            //mendapatkan akun dalam bentuk array
            $akun = $ambil->fetch_assoc();
            //simpan di session akun_user
            $_SESSION["akun_user"] = $akun;
            echo "<script>alert('anda sukses login');</script>";
            echo "<script>location='form.php';</script>";
            //jika sudah belanja
            // if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
            // {
            //   echo "<script>location='checkout.php';</script>";           
            // }
            // else
            // {
            //   echo "<script>location='index.php';</script>";           
            // }
          }
           else 
           {
               //gagal login
               echo "<script>alert('anda gagal login');</script>";
               echo "<script>location='login.php';</script>";
           } 
        }
        ?>
          </form>
          <form method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <div class="input-field">
              <i class="fa fa-phone"></i>
              <input type="number" placeholder="Nomor Whatsapp Awali +62" name="wa_user" required />
            </div>
            <input type="submit" class="btn" value="Sign up" name="daftar" />
            <?php 

            if (isset($_POST["daftar"])) 
            {

              $username = $_POST["username"];
              $email = $_POST["email"];
              $wa = $_POST["wa_user"];
              $password = encrypt($_POST["password"]);
              //$password=encryptthis($_POST["password"], $key);
              // $alamat = $_POST["alamat"];
              // $telepon = $_POST["telepon"];

              //cek apakah email sudah digunakan
             $ambil = $koneksi->query("SELECT * FROM akun_user
                WHERE email_user='$email'");
              $cocok = $ambil->num_rows;
              if ($cocok==1) 
              {
                echo "<script>alert('email sudah terdaftar');</script>";
                echo "<script>location='login.php';</script>";
              }
              else
              {
                //query insert ke tabel user
                $koneksi->query("INSERT INTO akun_user
                  (email_user,password_user,username,wa_user)
                  VALUES('$email','$password','$username','$wa') ");

                
                echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
                echo "<script>location='login.php';</script>";
              }
            }
             ?>
           </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <p>
              Anda belum punya akun ? Silahkan Klik dibawah ini
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <p>
              Sudah punya akun ? Silahkan Klik Login
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Login
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    
    <footer>
      <a href="../admin/login.php" class="btn btn-info">Copy Right 2020</a>
    </footer>

    <script src="app.js"></script>
  </body>
</html>
