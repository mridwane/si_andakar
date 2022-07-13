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

$query = 'SELECT * FROM `tbltransac` WHERE transac_code = "' . $_GET["no_transaksi"] . '"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// membuat nomer otomatis untuk di tabel
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $jenis = $row['transac_type'];
    // cek Status Pending atau disetujui atau batal
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
    $query3 = 'SELECT * FROM `tblbuktitransfer` WHERE no_transac = "' . $_GET["no_transaksi"] . '" AND user="admin" AND
    status = "deny_adm_dp" OR status = "deny_adm_lns" ';
    $result3 = mysqli_query($db, $query3) or die(mysqli_error($db));
    $file_name_dp = "";
    $file_name_lunas = "";
    $besar_dana = 0;
    while ($row3 = mysqli_fetch_array($result3)) {

    $file_name_dp = $row3["file_name"];
    $besar_dana = $row3["nominal_trf"];
    }
    $query2 = 'SELECT * FROM `tblbuktitransfer` WHERE no_transac = "' . $_GET["no_transaksi"] . '" AND user="customer"
    AND status = "deny_adm_dp" OR status = "deny_adm_lns" ';
    $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
    $note_admin = "";
    while ($row2 = mysqli_fetch_array($result2)) {

    $note_admin = $row2["note"];
    }
    } elseif ($row['status'] == "deny_adm_lns") {
    $status = "Dibatalkan Admin";
    } else {
    $status = "Dibatalkan";
    }
    $total = $row['total_price'];
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
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Detail Pesanan
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/delivery_controller.php?action=selesai" method="POST">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code"
                                    value="<?= $_GET['no_transaksi'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jenis Pesanan</label>
                                <input type="text" class="form-control" value="<?= $jenis ?>" readonly />
                            </div>
                            <div>
                                <label for="">Status</label>
                                <input type="text" class="form-control" value="<?= $status ?>" readonly />
                            </div>
                            <div>
                                <label for="">Total Pesanan</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($total, 0, ',', '.'); ?>" readonly />
                            </div>
                            <?php if ($status == "Pending") { ?>
                            <span>*Pesanan Anda Belum Selesai</span>
                            <?php } elseif ($status == "Sudah Bayar" || $status == "Sudah Bayar Ulang") { ?>
                            <h4>Pesanan kamu sedang kami proses, mohon untuk menunggu.</h4>
                            <?php } elseif ($status == "Dikirim") { ?>
                            <h4>Pesanan anda telah kami kirim ke alamat anda.</h4>
                            <span>*Jika pesanan anda telah selesai, silahkan klik tombol selesai.</span>
                            <div class="btn-box">
                                <button type="submit">Pesanan Selesai</button>
                            </div>
                            <?php } elseif ($status == "Selesai") { ?>
                            <h4>Pesanan anda telah selesai.</h4>
                            <!-- tombol tomtol untuk pesanan delivery -->
                            <?php } elseif ($status == "Disetujui" && strtoupper($jenis) == strtoupper("delivery")) { ?>
                            <h4>Pesanan anda sedang kami buat, mohon untuk menunggu.</h4>
                            <?php } elseif ($status == "Pelunasan Tidak Sesuai" && strtoupper($jenis) == strtoupper("delivery")) { ?>
                            <h4>Transfer Pelunasan yang telah anda lakukan tidak sesuai dengan nominal seharusnya, klik
                                disini untuk melihat rincian dan lakukan ulang pembayaran</h4>
                            <a href="delivery_revisi_lns.php?no_transaksi=<?php echo $_GET['no_transaksi']; ?>"
                                class="btn btn-danger">Lihat Rincian / Upload Ulang</a>
                            <?php } elseif ($status == "Disetujui" && strtoupper($jenis) == strtoupper("delivery")) { ?>
                            <h4>Pesanan anda telah kami terima. Mohon melakukan pelunasan SISA BAYAR maksimal h-2 dari
                                jadwal yang telah dipilih.</h4>
                            <div>
                                <label for="">Anda Harus Membayar Sebesar</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format(($subtotal + $pajak), 0, ',', '.'); ?>" readonly />
                            </div>
                            <label for="upload">Upload Bukti Transfer Pelusanan</label>
                            <input type="file" class="form-control" id="upload_pelunasan" name="upload_pelunasan"
                                accept=".jpeg, .jpg, .png">
                            <div class="btn-box">
                                <button type="submit" name="submit_pelunasan">Submit Pelunasan</button>
                            </div>
                            <?php } ?>
                        </form>
                        <div class="btn-black">
                            <button onclick="history.back()">
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/order_detail.svg" alt="">
                </div>
            </div>
        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>