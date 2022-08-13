<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';

  $query = 'SELECT * FROM `tbltransac` WHERE transac_code ="' . $_GET['id'] . '"';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  while ($row = mysqli_fetch_array($result)) {
    $stats = $row['status'];
    $cd = $row['transac_code'];
    $tgl = $row['date'];
    $order_type = $row['transac_type'];
  }

  $status_strng = "";
  if (strtoupper($stats) == strtoupper("dp")) {
    $status_strng = "Sudah Bayar DP";
  } else if (strtoupper($stats) == strtoupper("revisi_dp")) {
    $status_strng = "DP Tidak Sesuai";
  } else if (strtoupper($stats) == strtoupper("after_revision")) {
    $status_strng = "Sudah Bayar Ulang DP";
  } else if (strtoupper($stats) == strtoupper("pelunasan")) {
    $status_strng = "Sudah Bayar Pelunasan";
  } else if (strtoupper($stats) == strtoupper("revisi_pelunasan")) {
    $status_strng = "Pelunasan Tidak Sesuai";
  } else if (strtoupper($stats) == strtoupper("after_revision_lns")) {
    $status_strng = "Sudah Bayar Ulang Pelunasan";
  } else if (strtoupper($stats) == strtoupper("lunas")) {
    $status_strng = "Lunas";
  } else if (strtoupper($stats) == strtoupper("confirmed")) {
    $status_strng = "Disetujui";
  } else if (strtoupper($stats) == strtoupper("sending")) {
    $status_strng = "Dikirim";
  } else if (strtoupper($stats) == strtoupper("done")) {
    $status_strng = "Selesai";
  } else if (strtoupper($stats) == strtoupper("Paid")) {
    $status_strng = "Sudah Bayar";
  } else if (strtoupper($stats) == strtoupper("pending")) {
    $status_strng = "Pending";
  } else if (strtoupper($stats) == strtoupper("deny_adm_dp")) {
    $status_strng = "Dibatalkan Admin (Telah Membayar DP)";
  } else if (strtoupper($stats) == strtoupper("deny_adm_lns")) {
    $status_strng = "Dibatalkan Admin (Telah Membayar Pelunasan)";
  } else {
    $status = "Dibatalkan";
  }

?>


<div class="card">
  <div class="card-header">
    <div style="margin-bottom: 30px">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">No. Pemesanan : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $cd; ?>" readonly>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Status Pesanan : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $status_strng; ?>" readonly>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Tanggal & Waktu : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $tgl; ?>" readonly>
      </div>
    </div>
    <div class="card-body">
      <h4 style="color: blue">Informasi Pemesanan</h4>
      <div class="table-responsive">
        <table class="table" cellpadding="5" width="100%" cellspacing="0">
          <thead class="table-primary">
            <tr>
              <th>Produk</th>
              <th>Tanggal Pesanan</th>
              <th>Jumlah</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // $query = 'SELECT * FROM `tbltransac` a, `tblproducts` b, `tbltransacdetail` c WHERE
              // c.product_code=b.product_id AND a.transac_code="'.$_GET['id'].'"';
              $query = 'SELECT * FROM `tbltransac` a
                INNER JOIN `tbltransacdetail` b on a.transac_code=b.transac_code JOIN `tblproducts` c on
                b.product_code=c.product_id JOIN `tblsaus` d on b.kd_saus=d.id_saus WHERE a.transac_code ="' . $_GET['id'] . '"';
              $result = mysqli_query($db, $query) or die(mysqli_error($db));

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['product_name'] .  "+" . $row["nama_saus"] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['qty'] . '</td>';
                echo '<td>' . number_format($row['harga']) . '</td>';
                echo '<td>  ';
                /*echo '<center> <a  type="button" class="btn btn-lg btn-info fas fa-cart-plus" href="addtransacdetail.php?action=edit & id='.$row['transac_id'] . '"></a> </td></center>';*/
                echo '</tr> ';
              }
              ?>
            <?php
              $query = 'SELECT * FROM tbltransac
                WHERE
                transac_code ="' . $_GET['id'] . '"';
              $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while ($row = mysqli_fetch_array($result)) {

              ?>
          </tbody>
        </table>
        <br>
        <?php
                $query = 'SELECT * FROM tbltransac
                WHERE
                transac_code ="' . $_GET['id'] . '"';
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                $pajak = 0;
                $subtotal = 0;
                while ($row2 = mysqli_fetch_array($result)) {
                  $subtotal = $row2["subtotal"];
                  $pajak = $row2["tax_sepuluh"];
                  $biaya_kirim = $row2["biaya_kirim"];
                  $total = $row['total_price'];
                  $dp = $row['dp'];
                  $pelunasan = $row['pelunasan'];
                  $sisa = $total - $dp;
                  $total_pembayaran = $dp + $pelunasan;
                }?>
        <div class="row">
          <div class="col-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">TOTAL KESELURUHAN : </span>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($total); ?>" readonly>
            </div>
          </div>
        </div>
        <a href="print/tag_order.php?no_transaksi=<?php echo $_GET['id']; ?>" target="_blank"
          class="btn btn-xs btn-success"><i class="fas fa-sign-out-alt"></i>Cetak Tag Order</a>
        <!-- <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a> -->
        <?php    }  ?>




        <script>
          function confirmf(transacid) {
            var person = prompt("Masukan Penerima Barang");
            if (person == null || person == "") {

            } else {
              if (person == isNaN()) {
                alert("Nama Penerima Tidak Valid");
              } else {
                window.location.href = 'confirm.php?action=edit & confirmdelivery=' + transacid + ' & receiver=' +
                  person + ''
              }
            }
          }
        </script>



      </div>
    </div>
    <?php
      $query = 'SELECT * FROM tbltransac
              WHERE
              transac_code ="' . $_GET['id'] . '"';
      $result = mysqli_query($db, $query) or die(mysqli_error($db));
      while ($row = mysqli_fetch_array($result)) {
        //  $zz = $row['totalprice'];
      }


      ?>
    <?php



      ?>

  </div>



</div><br>


<?php include 'theme/footer.php';
  include 'controller/admin_reservasi_controller.php';
} ?>
