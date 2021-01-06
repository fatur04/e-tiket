<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>E-Ticketku</span></a></h1><br>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="../index.php">Home</a></li>
          <li><a href="#event">Cari Event</a></li>
        <li><a href="buat-event.php"><span class="glyphicon glyphicon-plus-sign"></span>Buat Event</a></li> 
        <?php if (isset($_SESSION["akun_user"])): ?>
          <li class="drop-down"><a href=""><?php echo $_SESSION["akun_user"]["username"] ?></a>
              <ul>
                <a href="riwayat.php">Riwayat Pembelian</a>
                <a href="riwayat_event.php">Riwayat Buat Event</a>
                <a href="#">Setting</a>
                <a href="logout.php">Logout</a>
              </ul>
            </li> 
            <?php else : ?>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->