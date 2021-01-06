<?php
include 'koneksi.php';
include 'enkripsi.php';
include '../format-tanggal.php';

date_default_timezone_set("ASIA/JAKARTA");

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

$id_event = $_GET["id"];

//ambil id_pembelian
$ambil = $koneksi->query("SELECT * FROM event 
                            WHERE event.id_event='$id_event'");
$detbay = $ambil->fetch_assoc();
// echo "<pre>";
// print_r($detbay);
// echo "</pre>";
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php
    
    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php',$Write);
    
?>
<script src="jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#getUID").load("UIDContainer.php");
        setInterval(function() {
               $("#getUID").load("UIDContainer.php");
       }, 500);
   });
</script>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h3>Pembuatan Event</h3>
        
            <table class="table table-responsive">
                <tr>
                    <th>Nama Event</th>
                    <td><?php echo $detbay["nama_event"] ?></td>
                </tr>
                <tr>
                    <th>Nama Penyelenggara</th>
                    <td><?php echo $detbay["selenggara"] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo $detbay["tanggal_start"] ?></td>
                </tr>
                <tr>
                    <th>Jam</th>
                    <td><?php echo $detbay["start"] ?>
                        <?php echo $detbay["berakhir"] ?>
                    </td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?php echo $detbay["lokasi"] ?> </td>
                </tr>
                <tr>
                    <th>Kuota</th>
                    <td><?php echo $detbay["stok_event"] ?> </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><textarea readonly value=""><?php echo $detbay["deskripsi_event"] ?></textarea></td>
                </tr>
            </table>
       
    </div>
    <div class="col-md-7">
        <center><img src="../foto event/<?php echo $detbay["foto_event"] ?>" alt="" class="img-responsive" height="300px"></center>
    </div>
  </div>

    <form method="post">
      <div class="col-md-6">
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="statuse" required>
                <option value="">Pilih Status</option>
                <option value="Sukses">Sukses</option>
                <option value="Pending">Batal</option>
            </select>
        </div>
        <button class="btn btn-primary" name="proses">Proses</button> 
       </div>
     </form>

   <?php 

    //update status pengiriman
     if (isset($_POST["proses"])) 
     {
        $status = $_POST["statuse"];

        $koneksi->query("UPDATE event SET status ='$status' 
            WHERE id_event='$id_event' ");

        echo "<script>alert('Data Terupdate');</script>";
        echo "<script>location='event.php';</script>";
     }

    ?> 

</div>
    
</section>


<?php
include('includes/footer.php');
include('includes/scripts.php');

?>