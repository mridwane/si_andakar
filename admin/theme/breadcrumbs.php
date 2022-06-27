<!-- Breadcrumbs-->
<?php
include('../includes/connection.php');
$query_delivery = 'SELECT COUNT(*) AS neworder FROM `tbltransac` WHERE `status` = "paid"';
$result = mysqli_query($db, $query_delivery) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);

?>

<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-comments"></i>
        </div>
        <div class="mr-5">Pengiriman!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">Melihat rincian</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-list"></i>
        </div>
        <div class="mr-5">Produk!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">Melihat rincian</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5"><?php
                          $neworder = $row['neworder'];
                          if ($neworder != 0) {
                            echo "Ada " . $neworder . " Pesanan baru!";
                          } else {
                            echo "Belum ada pesanan baru";
                          }
                          ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="../admin/detail.php">
        <span class="float-left">Lihat rincian</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-life-ring"></i>
        </div>
        <div class="mr-5">Baru !</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">Pelanggan</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>




<!-- Fontawesome -->
<link href=css/font-awesome.min.css" rel="stylesheet">

<!-- Bootstrap -->
<link href="css/1bootstrap.min.css" rel="stylesheet">
<script src="js/1indexes.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/1jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/1bootstrap.min.js"></script>