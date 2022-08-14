<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Dinein";
    include 'includes/header.php';
}

$query = 'SELECT *, SUM(b.qty) as jumlah FROM `tbltransac` a INNER JOIN `tbltransacdetail` b ON a.transac_code = b.transac_code WHERE a.transac_code = "' . $_GET['no_transaksi'] . '"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);
$jumlah = $row['jumlah'];
$total = $row['total_price'];
$pajak = $total * 0.10;
$total_bayar = $total + $pajak;
?>


<body class="sub_page" data-page="<?= $page ?>">
    <div class="hero_area">
        <div class="bg-box">
            <img src="../assets/images/hero-bg.jpg" alt="">
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
                        <form action="" enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code"
                                    value="<?= $_GET['no_transaksi'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah Pesanan</label>
                                <input type="text" class="form-control" value="<?= $jumlah ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumplah Total</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($total, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Pajak 10%</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($pajak, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah yang harus dibayar</label>
                                <input type="text" class="form-control"
                                    value="Rp. <?= number_format($total_bayar, 0, ',', '.'); ?>" readonly />
                            </div>
                        </form>
                        <div class="btn-box">
                            <a href="print/receipt_dinein.php?no_transaksi=<?php echo $_GET['no_transaksi']; ?>"
                                target="_blank">
                                <button>
                                    Cetak Struk
                                </button>
                            </a>
                        </div>
                        <div class="btn-black">
                            <a href="pos.php">
                                <button>
                                    Kembali
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="../assets/images/order_detail.svg" alt="">
                </div>
            </div>
        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>