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

?>

<div class="container-fluid">
      <h1>Dashboard</h1>
	  <br>    

              <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <?php 
            $jopok=$koneksi->query("SELECT * FROM pendaftar");
            $jumlah_pendaftar = mysqli_num_rows($jopok);

             ?>
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendaftar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_pendaftar; ?>  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <?php 
            $ambil=$koneksi->query("SELECT SUM(jumlah) as total FROM pembayaran ");
			$jumlah =$ambil->fetch_assoc();
			$total_harga = $jumlah['total'];
             ?>
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total_harga); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <?php 
            $lunas=$koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'E-Ticket Terkirim' ");
            $jumlah_lunas = mysqli_num_rows($lunas);

             ?>
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Status Lunas</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_lunas ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <?php 
            $pending=$koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'Pending' ");
            $jumlah_pending = mysqli_num_rows($pending);

             ?>
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Status Pending</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $jumlah_pending ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
            <?php 
            $absen=$koneksi->query("SELECT * FROM absen");
            $jumlah_absen = mysqli_num_rows($absen);

             ?>
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="../aksesapi.php">Import Data Absen</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_absen; ?>  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

</div>

<?php
//include('includes/footer.php');
include('includes/scripts.php');

?>