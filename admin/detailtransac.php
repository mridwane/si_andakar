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

  $query_bukti_transfer = mysqli_query($db, 'SELECT * FROM `tblbuktitransfer` WHERE no_transac="' . $cd . '"');
  $row2 = mysqli_fetch_array($query_bukti_transfer);

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
        <?php if (strtoupper($order_type) == strtoupper("delivery")) { ?>
          <h5>Bukti Transfer : <?php echo '<a href="controller/download_file_transaksi.php?file_name=' . $row2['file_name'] . '&no_transac=' . $cd . '">Download Bukti Transfer</a>'; ?></h5>
        <?php }  ?>
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
              </tr>
            </thead>
            <tbody style="font-size: 20px">
              <?php
              // $query = 'SELECT * FROM `tbltransac` a, `tblproducts` b, `tbltransacdetail` c WHERE
              // c.product_code=b.product_id AND a.transac_code="'.$_GET['id'].'"';
              $query = 'SELECT * FROM `tbltransac` a
                INNER JOIN `tbltransacdetail` b on a.transac_code=b.transac_code INNER JOIN `tblproducts` c on
                b.product_code=c.product_id WHERE a.transac_code ="' . $_GET['id'] . '"';
              $result = mysqli_query($db, $query) or die(mysqli_error($db));

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['product_name'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['qty'] . '</td>';
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
                // $zz = $row['totalprice'];   
              ?>

                <!-- <tr>
              <td colspan="5" align="right"><br>
                <h5> Subtotal :</h5>
              </td>
              <td><br>
                <h5> Rp. <?php echo $zz - 10000; ?></h5>
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
          <?php if ($row['status'] == '0') { ?>
            <a title="Cancel" type="button" class="btn btn-xs btn-danger " onclick="return confirm('Apakah Anda ingin membatalkan transaksi?')" href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> "><i class="fas fa-minus-circle"></i>Batal</a>
            <a title="Confirm" type="button" class="btn btn-xs btn-info " onclick="return confirm('Apakah Anda ingin mengkonfirmasi transaksi?')" href="confirm.php?action=edit & confirm=<?php echo $row['transac_code']; ?>"><i class="fas fa-check"></i>Konfirmasi</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>

          <?php } elseif ($row['status'] == '1') { ?>
            <!-- <a title="Cancel" type="button" class="btn btn-xs btn-danger "
          onclick="return confirm('Apakah Anda ingin membatalkan transaksi?')"
          href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> "><i
            class="fas fa-minus-circle"></i>Batal</a> -->
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
            <!-- <?php echo '<a href="delivery_letter.php?id=' . $cd . '" class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Surat Jalan</a>' ?>
        <a title="confirmdelivery" type="button" class="btn btn-xs btn-success"
          onclick="confirmf(<?php echo $row['transac_code']; ?>)"><i class="fas fa-minus-circle"></i>Konfirmasi telah
          dikirim</a> -->

          <?php } elseif ($row['status'] == '2') { ?>
            <!-- <a title="Confirm" type="button" class="btn btn-xs btn-info "
          onclick="return confirm('Apakah Anda ingin mengkonfirmasi transaksi?')"><i
            class="fas fa-check"></i>Konfirmasi</a> -->
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif ($row['status'] == 'paid') { ?>
            <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=confirm" class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Buat Pesanan</a>
            <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
          <?php } elseif ($row['status'] == 'confirmed') { ?>
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
} ?>