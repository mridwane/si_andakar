<?php
session_start();
if (!isset($_SESSION["cid"])) {
    header("Location: login.php");
} else {
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Upload Ulang DP";
    include 'includes/header.php';
}

$query = 'SELECT *, SUM(b.qty) as jumlah FROM `tbltransac` a INNER JOIN `tbltransacdetail` b ON
    a.transac_code = b.transac_code WHERE
    a.transac_code = "' . $_GET["no_transaksi"] . '"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);
$jumlah = $row['jumlah'];
$total = $row['total_price'];
$pajak = $total * 0.10;
$biayaservice = $total * 0.05;
$totalkeseluruhan = $total + $pajak + $biayaservice;
$dp = $totalkeseluruhan * 0.5;

// qeeury tbl bukti transfer
$query2 = 'SELECT * FROM `tblbuktitransfer`  WHERE no_transac = "' . $_GET["no_transaksi"] . '" AND status = "revisi_pelunasan" AND user="customer"';
$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
$pembayaran_cust = 0;
$file_name = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $pembayaran_cust = $row2["nominal_trf"];
    $file_name = $row2["file_name"];
}

$query3 = 'SELECT * FROM `tblbuktitransfer`  WHERE no_transac = "' . $_GET["no_transaksi"] . '" AND status = "revisi_pelunasan" AND user="admin"';
$result3 = mysqli_query($db, $query3) or die(mysqli_error($db));
$file_name_dp = "";
$file_name_lunas = "";
while ($row3 = mysqli_fetch_array($result3)) {

    $file_name_dp = $row3["file_name"];
}


?>


<body class="sub_page" data-page="<?= $page ?>">
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
                    Rincian Ketidaksesuaian Transfer
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/catering_controller.php?action=savetrfrvslns" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code" value="<?= $_GET['no_transaksi'] ?>" readonly />
                                <input type="text" class="form-control" name="file_name" value="<?= $file_name; ?>" hidden />
                            </div>
                            <div>
                                <label for="">Nama Pemesan</label>
                                <input type="text" class="form-control" value="<?= $_SESSION['C_FNAME'] . ' ' . $_SESSION['C_LNAME'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah Item</label>
                                <input type="text" class="form-control" value="<?= $jumlah ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah Total (Sudah termasuk biaya Service dan pajak)</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($totalkeseluruhan, 0, ',', '.'); ?>" readonly />

                            </div>

                            <div>
                                <label for="">Sisa Bayar </label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($dp, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Pembayaran yang anda telah lakukan</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($pembayaran_cust, 0, ',', '.'); ?>" readonly />
                                <span> Kami telah melakukan transfer pengembalian sesuai dengan pemabayaran yang telah anda lakukan</span>
                                <h4><a href="controller/download_file_transaksi.php?file_name=<?php echo $file_name_dp ?>&no_transac=<?php echo $_GET['no_transaksi'] ?>">Download Bukti Transfer Pengembalian</a></h4>
                            </div>
                            <br>
                            <div>
                                <span>
                                    <b>*silahkan melakukan pembayaran ke rekening (No.rekening) sesuai dengan SISA BAYAR (BUKAN TOTAL KESELURUHAN), Jika sudah silahkan
                                        upload bukti transfer dibawah ini.
                                    </b>
                                </span>
                                <label for="upload">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" id="upload" name="upload" accept=".jpeg, .jpg, .png">
                            </div>
                            <div class="btn-box">
                                <button type="submit" class="btn-konfirmasi-pembayaran" name="confirm">
                                    Konfirmasi Pembayaran
                                </button>
                            </div>
                            <br>
                            <div class="btn-box">
                                <a href="controller/catering_controller.php?action=cancel&no_pemesanan=<?php echo $_GET['no_transaksi'] ?>" class="batal btn btn-danger" type="button" data-status="2">Batalkan Pesanan</a>
                            </div>
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