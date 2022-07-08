<?php
session_start();
if (!isset($_SESSION["cid"])) {
    header("Location: login.php");
} else {
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Rincian Catering";
    include 'includes/header.php';
}

$query = 'SELECT *, SUM(b.qty) as jumlah FROM `tbltransac` a INNER JOIN `tbltransacdetail` b ON
    a.transac_code = b.transac_code WHERE
    a.transac_code = "' . $_GET["no_transaksi"] . '"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);
$jumlah = $row['jumlah'];
$total = $row['total_price'];
$selected_date = $row['reservation_date_time'];
$pajak = $total * 0.10;
$biayaservice = $total * 0.05;
$totalkeseluruhan = $total + $pajak + $biayaservice;
$dp = $totalkeseluruhan * 0.5;
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
                    Rincian Pemesanan Catering
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/catering_controller.php?action=savetrf" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code" value="<?= $_GET['no_transaksi'] ?>" readonly />
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
                                <label for="">Untuk Tanggal</label>&nbsp;
                                <?php
                                $date = date("Y-m-d");
                                $margin_date2 = date("d", strtotime($selected_date)) - date("d", strtotime($date));
                                if ($margin_date2 >= 2) { ?>
                                    <a type="button" href="#" class="btn-detail" data-toggle="modal" data-target="#update_modal<?php echo $_GET['no_transaksi']; ?>"><span class="material-icons">
                                            Ubah jadwal
                                        </span></a>
                                <?php
                                } ?>

                                <input type="text" class="form-control" value="<?= $selected_date ?>" readonly />
                            </div>
                            <div>
                                <label for="">Alamat Pengirim</label>
                                <?php
                                $query = 'SELECT * FROM `tblcustomer`a JOIN `tblalamat`b ON a.C_ADRESSID=b.id_alamat WHERE a.C_ID = "' . $_SESSION["cid"] . '"';
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $alamat = $row['alamat'];
                                }
                                ?>
                                <textarea name="alamat" id="" class="form-control" cols="30" rows="10" readonly><?= $alamat ?></textarea>
                            </div>
                            <div>
                                <label for="">Service 5% (Ongkos Kirim, Layanan, Packing)</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($biayaservice, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Pajak 10%</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($pajak, 0, ',', '.'); ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jumlah Total (Sudah termasuk biaya Service dan pajak)</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($totalkeseluruhan, 0, ',', '.'); ?>" readonly />

                            </div>
                            <div>
                                <label for="">DP 50% Yang harus dibayar</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($dp, 0, ',', '.'); ?>" readonly />
                            </div>
                            <br>
                            <div>
                                <span>
                                    *silahkan melakukan pembayaran ke rekening <b>BANK BCA (525 019 1873) atas nama
                                        Yanuar R. Arief</b> sesuai dengan DP (DOWN
                                    PAYMENT, BUKAN TOTAL KESELURUHAN), Jika sudah silahkan
                                    upload bukti transfer dibawah ini.
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
    <!-- moodal untuk update tanggal -->
    <div class="modal fade" id="update_modal<?php echo $_GET['no_transaksi']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="controller/catering_controller.php?action=ubah_jadwal">
                    <div class="modal-header">
                        <h3 class="modal-title">Ubah Jadwal</h3>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>No Pemesanan</label>
                                <input type="text" name="transac_code" value="<?php echo $_GET['no_transaksi'] ?>" class="form-control" readonly />
                                <input type="text" name="status" value="<?php echo $stats ?>" class="form-control" hidden />
                            </div>
                            <div class="form-group">
                                <label for="date">Pilih Jadwal</label>
                                <input type="datetime-local" class="form-control" id="date" name="date">
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button type="submit" name="ubah_jadwal" id="ubah_jadwal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>