<?php
session_start();
if (!isset($_SESSION["cid"])) {
    header("Location: login.php");
} else {
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Delivery";
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
$biayakirim = 10000;
$total_bayar = $total + $pajak + $biayakirim;
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
                    Rincian Pemesanan
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/delivery_controller.php?action=savetrf" method="POST"
                            enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code"
                                    value="<?= $_GET['no_transaksi'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Nama Pemesan</label>
                                <input type="text" class="form-control"
                                    value="<?= $_SESSION['C_FNAME'] . ' ' . $_SESSION['C_LNAME'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah Pesanan</label>
                                <input type="text" class="form-control" value="<?= $jumlah ?>" readonly />
                            </div>
                            <div>
                                <label for="">Alamat Pengirim</label>
                                <?php 
                                    $query = 'SELECT * FROM `tblcustomer`a JOIN `tblalamat`b ON a.C_ADRESSID=b.id_alamat WHERE a.C_ID = "'.$_SESSION["cid"].'"';
                                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $alamat = $row['alamat'];
                                    }
                                ?>
                                <textarea name="alamat" id="" class="form-control" cols="30" rows="10"
                                    readonly><?= $alamat ?></textarea>
                            </div>
                            <div>
                                <label for="">Pajak 10%</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($pajak, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Biaya Kirim</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($biayakirim, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah yang harus dibayar</label>
                                <input type="text" name="total_price" value="<?= $total_bayar ?>" hidden>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($total_bayar, 0, ',', '.'); ?>" readonly />
                                <span>*silahkan melakukan pembayaran ke rekening <b>BANK BCA (525 019 1873) atas nama
                                        Yanuar R. Arief</b> , Jika sudah silahkan
                                    upload bukti transfer dibawah ini.
                                </span>
                            </div>
                            <br>
                            <div>
                                <label for="upload">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" id="upload" name="upload"
                                    accept=".jpeg, .jpg, .png">
                            </div>
                            <div class="btn-box">
                                <button type="submit" class="btn-konfirmasi-pembayaran" name="confirm">
                                    Konfirmasi Pembayaran
                                </button>
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