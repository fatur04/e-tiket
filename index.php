<?php
session_start();
include 'web/koneksi.php';
include 'format-tanggal.php';
//include 'admin/enkripsi.php';
include 'url.php';

date_default_timezone_set("ASIA/JAKARTA");

unset($_SESSION["keranjang"]);

//echo "<pre>";
//print_r($_SESSION["keranjang"]);
//echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Ticketku</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="web/assets/img/polines.png" rel="icon">
  <link href="web/assets/img/polines.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="web/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="web/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="web/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="web/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="web/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="web/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="web/assets/css/style.css" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>E-Ticketku</span></a></h1><br>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="#event">Cari Event</a></li>
        <li><a href="web/buat-event.php"><span class="glyphicon glyphicon-plus-sign"></span>Buat Event</a></li> 
        <?php if (isset($_SESSION["akun_user"])): ?>
          <li class="drop-down"><a href=""><?php echo $_SESSION["akun_user"]["username"] ?></a>
              <ul>
                <a href="web/riwayat.php">Riwayat Pembelian</a>
                <a href="web/riwayat_event.php">Riwayat Buat Event</a>
                <a href="settingpassword.php">Setting</a>
                <a href="web/logout.php">Logout</a>
              </ul>
            </li> 
            <?php else : ?>
          <li><a href="web/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Web yang Menyediakan Event Online</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Lebih Mudah dan Ga Pake Ribet</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="#event" class="btn-get-started scrollto">Dapatkan Sekarang</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="web/assets/img/gambar.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="event" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Temukan Event Sesuai Pilihanmu</h2>
        </div>

        <div class="row content">
        <?php $ambil = $koneksi->query("SELECT * FROM event") ?>
        <?php while ($perproduk = $ambil->fetch_assoc()) { ?>

          <?php if ($perproduk['status']=="Sukses"): ?> 
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
            <p>
              <img src="foto event/<?php echo $perproduk['foto_event'] ?>" class="img-thumbnail" width="450px" height="400" alt="" >
            </p>
            <ul>
              <?php echo $perproduk['nama_event'] ?>
            </ul>
            <ul>
              <span class='fas fa-address-card' style='font-size:20px'></span>&#160;
              <?php echo $perproduk['selenggara'] ?>
            </ul>
            <ul>
              <span class="fas fa-calendar-alt" style='font-size:20px'></span>&#160;&#160;
            <span><?php echo tgl_indonesia($perproduk['tanggal_start']) ?></span>
            </ul>
            <ul>
              <span class='fas fa-map-marked-alt' style='font-size:20px'></span>&#160;
              <?php echo $perproduk['lokasi'] ?>
            </ul>
            <ul>
              <?php //echo $perproduk['id_event'];
                    //$enkripsi=encryptthis($perproduk['id_event'], $key); 
                    //$enkripsi=encrypt($perproduk['id_event']);?>

              <?php if ($perproduk['stok_event']<="0"): ?>
                <button class="btn btn-warning">Event Habis</button>
              <?php else: ?>
                <a href="web/detail.php?id=<?php echo $perproduk['id_event'] ?>" class="btn btn-primary" onSubmit="window.location.reload()">Beli</a>
              <?php endif ?>
              
            </ul>
          </div>
        <?php endif ?>
        <?php } ?>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kritik dan Saran</h2>
        </div>

        <div class="row">

          <div class="col-lg-6 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>Patur Jl Tlogosari II Tembalang, Semarang</p>
              </div>

              <div>
                <i class="ri-mail-send-line"></i>
                <p>patur@gmail.com</p>
              </div>

              <div>
                <i class="ri-phone-line"></i>
                <p>+62 831 0739 6111</p>
              </div>

            </div>
          </div>

          <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="300">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<!--   <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a> -->

  <!-- Vendor JS Files -->
  <script src="web/assets/vendor/jquery/jquery.min.js"></script>
  <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="web/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="web/assets/vendor/php-email-form/validate.js"></script>
  <script src="web/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="web/assets/vendor/counterup/counterup.min.js"></script>
  <script src="web/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="web/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="web/assets/vendor/venobox/venobox.min.js"></script>
  <script src="web/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="web/assets/js/main.js"></script>

</body>

</html>