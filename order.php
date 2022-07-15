<?php
session_start();
if (!isset($_SESSION["cid"])) {
    header("Location: login.php");
} else {
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Detail Order";
    include 'includes/header.php';
}
?>


<body class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
            <img src="assets/images/hero-bg.jpg" alt="">
        </div>
        <!-- navigation strats -->
        <?php include 'includes/navigation.php'; ?>
        <!-- end navigation-->
    </div>
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h3>
                    List Pesanan Kamu
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Jenis Transaksi</th>
                                <th>Status</th>
                                <th>Tanggal dan Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = 'SELECT * FROM `tbltransac` WHERE customer_id = "' . $_SESSION["cid"] . '" ORDER BY
                            reservation_date_time DESC';
                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            // membuat nomer otomatis untuk di tabel
                            $no = 1;
                            $link = "";
                            while ($row = mysqli_fetch_assoc($result)) {
                                // cek Status Pending atau disetujui
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
                                $status = "Sudah Bayar Ulang";
                                } elseif ($row['status'] == "lunas") {
                                $status = "Lunas";
                                } elseif ($row['status'] == "confirmed") {
                                $status = "Disetujui";
                                } elseif ($row['status'] == "sending") {
                                $status = "Dikirim";
                                } elseif ($row['status'] == "done") {
                                $status = "Selesai";
                                } elseif ($row['status'] == "deny_adm_dp" || $row['status'] == "deny_adm_lns") {
                                $status = "Dibatalkan Admin";
                                }
                                if (strtoupper($row['transac_type']) == strtoupper("delivery")) {
                                    $link = "order_detail_delivery.php";
                                    $rincian = "delivery_rincian.php";
                                } elseif (strtoupper($row['transac_type']) == strtoupper("catering")) {
                                    $link = "order_detail_catering.php";
                                    $rincian = "catering_rincian.php";
                                } elseif (strtoupper($row['transac_type']) == strtoupper("reservasi")) {
                                    $link = "order_detail_reservasi.php";
                                    $rincian = "reservasi_rincian.php";
                                }
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $row['transac_code'] . '</td>';
                                echo '<td>' . $row['transac_type'] . '</td>';
                                echo '<td>' . $status . '</td>';
                                echo '<td>' . $row['reservation_date_time'] . '</td>';
                                if ($row['status'] == "pending") {
                                echo '<td><a type="button" class="btn-detail"
                                        href="' . $rincian . '?&no_transaksi=' . $row['transac_code'] . '">
                                        <span class="material-icons">
                                            Detail
                                        </span>
                                    </a>
                                </td>';
                                }
                                else{
                                    echo '<td><a type="button" class="btn-detail"
                                            href="' . $link . '?&no_transaksi=' . $row['transac_code'] . '">
                                            <span class="material-icons">
                                                Detail
                                            </span>
                                        </a>
                                    </td>';
                                }
                                echo '</tr> ';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>