<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';
?>


<div class="card mb-3">
  <div class="card-header">
    <h2>Semua Transaksi</h2>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No. Pemesanan</th>
              <th>Pelanggan</th>
              <th>Tanggal Pemesanan</th>
              <th>Jenis Pesanan</th>
              <th>Status</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name FROM tbltransac a JOIN tblcustomer b ON
              a.`customer_id`=b.`C_ID` ORDER BY `reservation_date_time` DESC';
              $result = mysqli_query($db, $query) or die(mysqli_error($db));

              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == "pending") {
                $status = "Pending";
                } elseif ($row['status'] == "paid") {
                $status = "Sudah Bayar";
                } elseif ($row['status'] == "dp") {
                $status = "Sudah Bayar DP";
                } elseif ($row['status'] == "revisi_dp") {
                $status = "DP Tidak Sesuai";
                } elseif ($row['status'] == "after_revision") {
                $status = "Sudah Bayar Ulang DP";
                } elseif ($row['status'] == "pelunasan") {
                $status = "Sudah Bayar Pelunasan";
                } elseif ($row['status'] == "revisi_pelunasan") {
                $status = "Pelunasan Tidak Sesuai";
                } elseif ($row['status'] == "after_revision_lns") {
                $status = "Sudah Bayar Ulang Pelunasan";
                } elseif ($row['status'] == "lunas") {
                $status = "Lunas";
                } elseif ($row['status'] == "confirmed") {
                $status = "Disetujui";
                } elseif ($row['status'] == "sending") {
                $status = "Dikirim";
                } elseif ($row['status'] == "done") {
                $status = "Selesai";
                } elseif ($row['status'] == "cancel") {
                $status = "Dibatalkan Customer";
                } elseif ($row['status'] == "deny_adm_dp" || $row['status'] == "deny_adm_lns") {
                $status = "Dibatalkan Admin";
                }
                echo '<tr>';
                echo '<td>' . $row['transac_code'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['reservation_date_time'] . '</td>';
                echo '<td>' . $row['transac_type'] . '</td>';
                echo '<td>' . $status . '</td>';
                if($row['transac_type'] == "Catering"){
                echo '<td class="bungkus-tombol"><a title="View list Of Ordered" type="button" class="btn-detail"
                    href="detailtransac.php?id=' . $row['transac_code'] . '">
                    <span class="material-icons">
                      visibility
                    </span>
                  </a></td>';
                }
                elseif($row['transac_type'] == "Reservasi"){
                echo '<td class="bungkus-tombol"><a title="View list Of Ordered" type="button" class="btn-detail"
                    href="detailtransac_reservasi.php?id=' . $row['transac_code'] . '">
                    <span class="material-icons">
                      visibility
                    </span>
                  </a></td>';
                }
                elseif($row['transac_type'] == "Delivery"){
                echo '<td class="bungkus-tombol"><a title="View list Of Ordered" type="button" class="btn-detail"
                    href="detailtransac_delivery.php?id=' . $row['transac_code'] . '">
                    <span class="material-icons">
                      visibility
                    </span>
                  </a></td>';
                }
                echo '</tr> ';
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>


</div>
<!-- /.container-fluid -->

<?php include 'theme/footer.php';
} ?>
<?php include 'addtransac.php'; ?>