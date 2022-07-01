<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';

  $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER`,`C_ADDRESS` FROM `tbltransac` a INNER JOIN
  `tblcustomer` b on a.customer_id=b.C_ID WHERE a.transac_code ="' . $_GET['id'] . '"';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  while ($row = mysqli_fetch_array($result)) {
    $stats = $row['status'];
    $name = $row['name'];
    $contact = $row['C_PNUMBER'];
    $address = $row['C_ADDRESS'];
    $tgl_reservasi = $row['reservation_date_time'];
    $cd = $row['transac_code'];
    $order_type = $row['transac_type'];
  }

  $query_bukti_transfer = 'SELECT * FROM `tblbuktitransfer` WHERE no_transac="' . $cd . '" AND user="customer" ';
  $result2 = mysqli_query($db, $query_bukti_transfer) or die(mysqli_error($db));
  $file_name_dp = "";
  $file_name_lunas = "";
  while ($row2 = mysqli_fetch_array($result2)) {
    if (substr($row2["file_name"], 0, 5) != "BTLNS") {
      $file_name_dp = $row2["file_name"];
    } else {
      $file_name_lunas = $row2["file_name"];
    }
  }

?>


  <div class="card">
    <div class="card-header">
      <div style="margin-bottom: 30px">
        <h5>No. Pemesanan : <?php echo $cd; ?></h5>
        <h5>Nama : <?php echo $name; ?></h5>
        <h5>Kontak : 0<?php echo $contact; ?></h5>
        <h5>Alamat : <?php echo $address; ?></h5>
        <h5>Jenis Pesanan : <?php echo $order_type; ?></h5>
        <h5>Status Pesanan : <?php echo $stats; ?></h5>
        <h5>Tanggal & Waktu : <?php echo $tgl_reservasi; ?></h5>
        <?php if (strtoupper($order_type) == strtoupper("delivery") || strtoupper($order_type) == strtoupper("catering")) { ?>
          <?php if ($stats == "paid" || $stats == "dp" || $stats == "lunas" || $stats == "after_revision") { ?>
            <h5>Bukti Transfer <?php if ($order_type == "Catering") {
                                  echo " DP";
                                } ?>: <?php echo '<a href="controller/download_file_transaksi.php?file_name=' . $file_name_dp . '&no_transac=' . $cd . '">Download Bukti Transfer</a>'; ?></h5>

          <?php }
          if ($stats == "lunas") { ?>
            <h5>Bukti Transfer Pelunasan : <?php echo '<a href="controller/download_file_transaksi.php?file_name=' . $file_name_lunas . '&no_transac=' . $cd . '">Download Bukti Transfer</a>'; ?></h5>
        <?php
          }
        }  ?>
      </div>
      <div class="card-body">
        <h4 style="color: blue">Informasi Pemesanan</h4>
        <div class="table-responsive">
          <table cellpadding="5" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Tanggal Pesanan</th>
                <th>Jumlah</th>
                <th>Harga Makanan</th>
                <th>Harga Saus</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody style="font-size: 20px">
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
                echo '<td>' . number_format($row['price']) . '</td>';
                echo '<td>' . number_format($row['harga_saus']) . '</td>';
                echo '<td>' . number_format(($row['price'] + $row['harga_saus']) * $row['qty']) . '</td>';
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

                <!-- <tr>
              <td colspan="5" align="right"><br>
                <h5> Subtotal :</h5>
              </td>
              <td><br>
                <h5> Rp. <?php echo $row["total_price"]; ?></h5>
              </td>
            </tr>
            <tr>
              <td colspan="5" align="right">
                <h5> Biaya pengiriman :</h5>
              </td>
              <td>
                <h5> Rp. 10000</h5>
              </td>
            </tr>
            <tr>
              <td colspan="5" align="right">
                <h5> Total :</h5>
              </td>
              <td>
                <h5> Rp. <?php echo $zz; ?></h5>
              </td>
            </tr> -->


            </tbody>
          </table>
          <br>
          <?php
                $query = 'SELECT * FROM tbltransac
                WHERE
                transac_code ="' . $_GET['id'] . '"';
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                $pajak = 0;
                $service = 0;
                $subtotal = 0;
                while ($row2 = mysqli_fetch_array($result)) {
                  $service = $row2["total_price"] * 0.05;
                  $pajak = $row2["total_price"] * 0.10;
                  $subtotal = $row2["total_price"];
                }
                echo "SUB TOTAL : Rp. " . number_format($subtotal);
                echo "<br>";
                echo "BIAYA SERVICE 5% : Rp. " . number_format($service);
                echo "<br>";
                echo "PAJAK 10% : Rp. " . number_format($pajak);
                echo "<br>";
                echo "TOTAL KESELURUHAN : Rp. " . number_format(($subtotal + $pajak + $service));
                echo "<br>";
                echo "DP YANG HARUS DIBAYAR : Rp. " . number_format(($subtotal + $pajak + $service) / 2);
                echo "<br>";
                echo "<br>";

          ?>

          <!-- daftar tombol untuk type transaksi delivery -->
          <?php if (strtoupper($row["status"]) == '0' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
            <a title="Cancel" type="button" class="btn btn-xs btn-danger " onclick="return confirm('Apakah Anda ingin membatalkan transaksi?')" href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> "><i class="fas fa-minus-circle"></i>Batal</a>
            <a title="Confirm" type="button" class="btn btn-xs btn-info " onclick="return confirm('Apakah Anda ingin mengkonfirmasi transaksi?')" href="confirm.php?action=edit & confirm=<?php echo $row['transac_code']; ?>"><i class="fas fa-check"></i>Konfirmasi</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>

          <?php } elseif (strtoupper($row["status"]) == '1' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
            <!-- <a title="Cancel" type="button" class="btn btn-xs btn-danger "
          onclick="return confirm('Apakah Anda ingin membatalkan transaksi?')"
          href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> "><i
            class="fas fa-minus-circle"></i>Batal</a> -->
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
            <!-- <?php echo '<a href="delivery_letter.php?id=' . $cd . '" class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Surat Jalan</a>' ?>
         <a title="confirmdelivery" type="button" class="btn btn-xs btn-success"
          onclick="confirmf(<?php echo $row['transac_code']; ?>)"><i class="fas fa-minus-circle"></i>Konfirmasi telah
          dikirim</a> -->

          <?php } elseif (strtoupper($row["status"]) == '2' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
            <!-- <a title="Confirm" type="button" class="btn btn-xs btn-info "
          onclick="return confirm('Apakah Anda ingin mengkonfirmasi transaksi?')"><i
            class="fas fa-check"></i>Konfirmasi</a> -->
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif (strtoupper($row["status"]) == 'dp' && strtoupper($row["transac_type"]) == strtoupper("catering")) { ?>
            <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=confirm" class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Buat Pesanan</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif (strtoupper($row["status"]) == 'confirmed' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
            <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=send" class="btn btn-xs btn-danger"><i class="fas fa-sign-out-alt"></i>Kirimkan Pesanan</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php }





                //  daftar tombol untuk type transaksi catering


                elseif (strtoupper($row["status"]) == strtoupper("pending") && strtoupper($row["transac_type"]) == "catering") { ?>

            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif (strtoupper($row["status"]) == strtoupper("dp") || strtoupper($row["status"]) == strtoupper("after_revision") && strtoupper($row["transac_type"]) == strtoupper("catering")) { ?>
            <a href="controller/admin_catering_controller.php?no_transac=<?php echo $cd; ?>&action=confirm" class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Terima Pesanan</a>
            <a href="controller/admin_catering_controller.php?no_transac=<?php echo $cd; ?>&action=deny" class="btn btn-xs btn-danger"><i class="fas fa-sign-out-alt"></i>Tolak Pesanan</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_modal<?php echo $_GET['id']; ?>">Transfer Tidak Sesuai</button>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif (strtoupper($row["status"]) == strtoupper('confirmed') && strtoupper($row["transac_type"]) == strtoupper("catering")) { ?>
            <span>Menunggu Customer Melakukan Pelunasan</span>
          <?php } elseif (strtoupper($row["status"]) == 'confirmed' && strtoupper($row["transac_type"]) == "catering") { ?>
            <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=send" class="btn btn-xs btn-danger"><i class="fas fa-sign-out-alt"></i>Kirimkan Pesanan</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } ?>

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
      $query = 'SELECT * FROM tbltransacdetail
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
  include 'controller/admin_catering_controller.php';
} ?>