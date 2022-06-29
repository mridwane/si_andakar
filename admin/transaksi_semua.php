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
          <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
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
              $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name FROM tbltransac a, tblcustomer b WHERE a.`customer_id`=b.`C_ID`';
              $result = mysqli_query($db, $query) or die(mysqli_error($db));

              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == "pending") {
                  $status = "Pending";
                } elseif ($row['status'] == "paid") {
                  $status = "Sudah Bayar";
                } elseif ($row['status'] == "dp") {
                  $status = "Sudah Bayar Dp";
                } elseif ($row['status'] == "confirmed") {
                  $status = "Disetujui";
                } elseif ($row['status'] == "sending") {
                  $status = "Dikirim";
                } elseif ($row['status'] == "done") {
                  $status = "Selesai";
                } else {
                  $status = "Dibatalkan";
                }
                echo '<tr>';
                echo '<td>' . $row['transac_code'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['reservation_date_time'] . '</td>';
                echo '<td>' . $row['transac_type'] . '</td>';
                echo '<td>' . $status . '</td>';
                echo '<td class="bungkus-tombol"><a title="View list Of Ordered" type="button" class="btn-detail" href="detailtransac.php?id=' . $row['transac_code'] . '" >
                          <span class="material-icons">
                            visibility
                          </span>
                        </a></td>';
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