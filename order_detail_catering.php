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
    } elseif ($row['status'] == "lunas") {
        $status = "Lunas";
    } elseif ($row['status'] == "confirmed") {
        $status = "Disetujui";
    } elseif ($row['status'] == "sending") {
        $status = "Dikirim";
    } elseif ($row['status'] == "done") {
        $status = "Selesai";
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
                        <form action="controller/catering_controller.php?action=savetrflunas" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code" value="<?= $_GET['no_transaksi'] ?>" readonly />
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
                                <input type="text" class="form-control" value="Rp. <?= number_format($total, 0, ',', '.'); ?>" readonly />
                            </div>
                            <?php if ($status == "Pending") { ?>
                                <span>*Pesanan Anda Belum Selesai</span>
                            <?php } elseif ($status == "Sudah Bayar") { ?>
                                <h4>Pesanan kamu sedang kami proses, mohon untuk menunggu.</h4>
                            <?php } elseif ($status == "Sudah Bayar DP" || $status == "Sudah Bayar Ulang DP") { ?>
                                <h4>Terima kasih telah membayar down payment, Mohon menunggu konfirmasi dari kami</h4>
                            <?php } elseif ($status == "Lunas") { ?>
                                <h4>Terima kasih telah membayar pelunasan, Kami akan mengirimkan pesanan anda sesuai dengan jadwal yang tertera </h4>
                                <br>
                                <h6>*Jika ada yang ditanyakan silahkan hubungi kontak kami</h6>
                            <?php } elseif ($status == "Dikirim") { ?>
                                <h4>Pesanan anda telah kami kirim ke alamat anda.</h4>
                                <span>*Jika pesanan anda telah selesai, silahkan klik tombol selesai.</span>
                                <div class="btn-box">
                                    <button type="submit">Pesanan Selesai</button>
                                </div>
                            <?php } elseif ($status == "Selesai") { ?>
                                <h4>Pesanan anda telah selesai.</h4>
                                <!-- tombol tomtol untuk pesanan catering -->
                            <?php } elseif ($status == "DP Tidak Sesuai" && strtoupper($jenis) == strtoupper("catering")) { ?>
                                <h4>Transfer Down Payement (DP) yang telah anda lakukan tidak sesuai dengan nominal seharusnya, klik disini untuk melihat rincian dan lakukan ulang pembayaran</h4>
                                <a href="catering_revisi.php?no_transaksi=<?php echo $_GET['no_transaksi']; ?>" class="btn btn-danger">Lihat Rincian / Upload Ulang</a>
                            <?php } elseif ($status == "Disetujui" && strtoupper($jenis) == strtoupper("catering")) { ?>
                                <h4>Pesanan anda telah kami terima. Mohon melakukan pelunasan maksimal h-2 dari jadwal yang telah dipilih.</h4>
                                <label for="upload">Upload Bukti Transfer Pelusanan</label>
                                <input type="file" class="form-control" id="upload_pelunasan" name="upload_pelunasan" accept=".jpeg, .jpg, .png">
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