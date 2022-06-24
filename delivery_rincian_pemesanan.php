<?php
    session_start();
    if(!isset($_SESSION["cid"])){
    header("Location: login.php");
    }else{
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Delivery"; 
    include 'includes/header.php';
    }

    $query = 'SELECT *, SUM(b.qty) as jumlah FROM `tbltransac` a INNER JOIN `tbltransacdetail` b ON
    a.transac_code = b.transac_code WHERE
    a.transac_code = "'.$_GET["no_transaksi"].'"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row = mysqli_fetch_array($result);
    $jumlah = $row['jumlah'];
    $total = $row['total_price'];
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
                        <!-- <form action="#" method="POST"> -->
                        <div>
                            <label for="">No Transaksi</label>
                            <input type="text" class="form-control" name="transac_code"
                                value="<?= $_GET['no_transaksi'] ?>" readonly />
                        </div>
                        <div>
                            <label for="">Nama Pemesan</label>
                            <input type="text" class="form-control"
                                value="<?= $_SESSION['C_FNAME'].' '. $_SESSION['C_LNAME'] ?>" readonly />
                        </div>
                        <div>
                            <label for="">Jumlah Pesanan</label>
                            <input type="text" class="form-control" value="<?= $jumlah ?>" readonly />
                        </div>
                        <div>
                            <label for="">Alamat Pengirim</label>
                            <textarea name="alamat" id="" class="form-control" cols="30" rows="10"
                                readonly><?= $_SESSION['address'] ?></textarea>
                        </div>
                        <div>
                            <label for="">Jumlah yang harus dibayar</label>
                            <input type="text" class="form-control" value="Rp. <?= number_format($total,0,',','.'); ?>"
                                readonly />
                            <span>
                                <b>*silahkan melakukan pembayaran ke rekening (No.rekening), Jika sudah silahkan
                                    upload bukti transfer dibawah ini.
                                </b>
                            </span>
                        </div>
                        <br>
                        <div>
                            <label for="upload">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" id="upload" name="upload"
                                accept=".jpeg, .jpg, .png">
                        </div>
                        <div class="btn-box">
                            <button type="submit" class="btn-konfirmasi-pembayaran" onclick='swal("Terima kasih telah melakukan pemesanan!", "Pesanan anda akan kami proses dan dikirimkan mohon menunggu dan cek status pesanan di menu pesanan saya. ",
                                "success");'>
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                        <!-- </form> -->
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