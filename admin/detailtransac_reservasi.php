<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';

  $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER` FROM `tbltransac` a INNER JOIN
  `tblcustomer` b on a.customer_id=b.C_ID INNER JOIN
  `tblalamat` c on b.C_ADRESSID=c.id_alamat WHERE a.transac_code ="' . $_GET['id'] . '"';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  while ($row = mysqli_fetch_array($result)) {
    $stats = $row['status'];
    $name = $row['name'];
    $contact = $row['C_PNUMBER'];
    $address = $row['alamat'];
    $tgl_reservasi = $row['reservation_date_time'];
    $cd = $row['transac_code'];
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
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">No. Pemesanan : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $cd; ?>" readonly>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nama : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $name; ?>" readonly>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Kontak : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $contact; ?>" readonly>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Alamat : </span>
        </div>
        <input type="text" class="form-control" value="<?php echo $address; ?>" readonly>
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
        <input type="text" class="form-control" value="<?php echo $tgl_reservasi; ?>" readonly>
      </div>
      <?php if (strtoupper($order_type) == strtoupper("delivery") || strtoupper($order_type) == strtoupper("reservasi")) { ?>
      <?php if ($stats == "paid" || $stats == "dp" || $stats == "lunas" || $stats == "pelunasan" || $stats == "after_revision_lns" || $stats == "after_revision") { ?>
      <p>Bukti Transfer <?php if ($order_type == "Reservasi") {
                                  echo " DP";
                                } ?>:
        <?php echo '<a class="btn btn-primary" href="controller/download_file_transaksi.php?file_name=' . $file_name_dp . '&no_transac=' . $cd . '">Download Bukti Transfer</a>'; ?>
      </p>

      <?php }
          if ($stats == "lunas" || $stats == "pelunasan" || $stats == "after_revision_lns") { ?>
      <p>Bukti Transfer Pelunasan :
        <?php echo '<a class="btn btn-primary" href="controller/download_file_transaksi.php?file_name=' . $file_name_lunas . '&no_transac=' . $cd . '">Download Bukti Transfer</a>'; ?>
      </p>
      <?php
          }
        }  ?>
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
                        <span class="input-group-text" id="basic-addon1">SUB TOTAL : </span>
                      </div>
                      <input type="text" class="form-control" value="Rp. <?= number_format($subtotal); ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">PAJAK 10%: </span>
                      </div>
                      <input type="text" class="form-control" value="Rp. <?= number_format($pajak); ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">TOTAL KESELURUHAN : </span>
                      </div>
                      <input type="text" class="form-control" value="Rp. <?= number_format($total); ?>" readonly>
                    </div>
                  </div>
                  <div class="col-6">
                    <?php if ($stats == "pelunasan"){ ?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">DP YANG DIBAYARKAN : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($dp); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">PELUNASAN YANG HARUS DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($sisa); ?>" readonly>
                      </div>
                    <?php } elseif ($stats == "confirmed") { ?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">DP YANG HARUS DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($total / 2); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">DP YANG DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($dp); ?>" readonly>
                      </div>
                    <?php } elseif ($stats == "lunas") { ?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">DP YANG DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($dp); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">PELUNASAN YANG HARUS DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($sisa); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">SISA PEMBAYARAN : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($sisa); ?>" readonly>
                      </div>
                    <?php } elseif ($stats == "done") { ?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">DP YANG DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($dp); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">PELUNASAN YANG HARUS DIBAYAR : </span>
                        </div>
                        <input type="text" class="form-control" value="Rp. <?= number_format($sisa); ?>" readonly>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">SISA PEMBAYARAN : </span>
                        </div>
                        <input type="text" class="form-control"
                          value="Rp. <?= number_format($sisa); ?>" readonly>
                      </div>
                    <?php } ?>
                  </div>
                </div>

        <!-- daftar tombol untuk type transaksi delivery -->
        <?php if (strtoupper($row["status"]) == '0' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
        <a title="Cancel" type="button" class="btn btn-xs btn-danger "
          onclick="return confirm('Apakah Anda ingin membatalkan transaksi?')"
          href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> "><i
            class="fas fa-minus-circle"></i>Batal</a>
        <a title="Confirm" type="button" class="btn btn-xs btn-info "
          onclick="return confirm('Apakah Anda ingin mengkonfirmasi transaksi?')"
          href="confirm.php?action=edit & confirm=<?php echo $row['transac_code']; ?>"><i
            class="fas fa-check"></i>Konfirmasi</a>
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
        <?php } elseif (strtoupper($row["status"]) == 'dp' && strtoupper($row["transac_type"]) == strtoupper("reservasi")) { ?>
        <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=confirm"
          class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Buat Pesanan</a>
        <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
        <?php } elseif (strtoupper($row["status"]) == 'confirmed' && strtoupper($row["transac_type"]) == strtoupper("delivery")) { ?>
        <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=send"
          class="btn btn-xs btn-danger"><i class="fas fa-sign-out-alt"></i>Kirimkan Pesanan</a>
        <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
        <?php }





                //  daftar tombol untuk type transaksi reservasi


                elseif (strtoupper($row["status"]) == strtoupper("pending") && strtoupper($row["transac_type"]) == "reservasi") { ?>

        <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
        <?php } elseif (strtoupper($row["status"]) == strtoupper("dp") || strtoupper($row["status"]) == strtoupper("after_revision") && strtoupper($row["transac_type"]) == strtoupper("reservasi")) { ?>
        <!-- <a href="controller/admin_reservasi_controller.php?no_transac=<?php echo $cd; ?>&action=confirm"
          class="btn btn-xs btn-info"><i class="fas fa-sign-out-alt"></i>Terima Pesanan</a> -->
        <button type="button" class="btn btn-info" data-toggle="modal"
          data-target="#dp_modal<?php echo $_GET['id']; ?>">Terima Pesanan</button>
        <button type="button" class="btn btn-danger" data-toggle="modal"
          data-target="#deny_modal<?php echo $_GET['id']; ?>">Tolak Pesanan</button>
        <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
        <?php } elseif (strtoupper($row["status"]) == strtoupper("pelunasan") || strtoupper($row["status"]) == strtoupper("after_revision_lns") && strtoupper($row["transac_type"]) == strtoupper("reservasi")) { ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#accept_modal<?php echo $_GET['id']; ?>">Buat Pesanan</button>
        <button type="button" class="btn btn-danger" data-toggle="modal"
          data-target="#deny_modal<?php echo $_GET['id']; ?>">Tolak Pesanan</button>
        <a href="detail.php" class="btn btn-xs btn-warning"><i class="fas fa-sign-out-alt"></i>Kembali</a>
        <?php } elseif (strtoupper($row["status"]) == strtoupper('confirmed') && strtoupper($row["transac_type"]) == strtoupper("reservasi")) { ?>
        <span>Menunggu Customer Melakukan Pelunasan</span>
        <?php } elseif (strtoupper($row["status"]) == strtoupper('done') && strtoupper($row["transac_type"]) == strtoupper("reservasi")) { ?>
        <span></span><br>
        <a href="print/invoice_reservasi.php?no_transaksi=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-xs btn-primary"><i
            class="fas fa-sign-out-alt" ></i>Cetak Nota</a>
        <a href="print/tag_order.php?no_transaksi=<?php echo $_GET['id']; ?>" target="_blank"
          class="btn btn-xs btn-success"><i class="fas fa-sign-out-alt"></i>Cetak Tag Order</a>
        <?php } elseif (strtoupper($row["status"]) == 'confirmed' && strtoupper($row["transac_type"]) == "reservasi") { ?>
        <a href="controller/admin_delivery_controller.php?no_transac=<?php echo $cd; ?>&action=send"
          class="btn btn-xs btn-danger"><i class="fas fa-sign-out-alt"></i>Kirimkan Pesanan</a>
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