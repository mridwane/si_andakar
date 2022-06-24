<?php
    session_start();
    if(!isset($_SESSION["cid"])){
    header("Location: login.php");
    }else{
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Status kemitraan"; 
    include 'includes/header.php';
    }

    $query = 'SELECT a.regis_no, a.date_req, a.status, b.note FROM `tblrequestmitra` a INNER JOIN
    `tbldetailrequestmitra` b ON a.C_ID = b.user_id WHERE
    a.C_ID = "'.$_SESSION["cid"].'"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    // membuat nomer otomatis untuk di tabel
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $regis_no = $row['regis_no'];
        $tgl = $row['date_req'];
        $status = $row['status'];
        $keterangan = $row['note'];
    }

    $cek = mysqli_query($db, 'SELECT C_ID FROM tblrequestmitra WHERE C_ID = "'.$_SESSION["cid"].'"');
    // echo $cek->num_rows;
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
    <?php if ($cek->num_rows > 0) {?>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Status Kemitraan
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/kemitraan_controller.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" name="transac_code" value="<?= $regis_no ?>"
                                    readonly />
                            </div>
                            <div>
                                <label for="">Tanggal Request</label>
                                <input type="text" class="form-control" value="<?= $tgl ?>" readonly />
                            </div>
                            <div>
                                <label for="">Status</label>
                                <input type="text" class="form-control" value="<?= $status ?>" readonly />
                            </div>
                            <div>
                                <label for="">Keterangan</label>
                                <textarea type="text" class="form-control" readonly cols="10" rows="4">
                                <?= $keterangan ?>
                            </textarea>
                            </div>
                            <?php if ($status == "unconfirmed") { ?>
                            <div>
                                <label for="upload">Upload Ulang Persayaratan</label>
                                <input type="file" class="form-control" id="upload" name="upload"
                                    onchange="validasifile2()" accept=".pdf, .docx, .doc">
                                <span>*File harus PDF/Word, max 5 MB </span>
                            </div>
                            <div class="btn-box">
                                <button type="submit" name="reupload">
                                    Kirim Ulang Persyaratan
                                </button>
                            </div>
                            <?php }elseif($status == "Pending") {?>
                            <div class="btn-red">
                                <button type="submit">
                                    Batalkan Pesanan
                                </button>
                            </div>
                            <?php }elseif($status == "Disetujui") {?>
                            <h4>Terimakasih sudah melakukan reservasi</h4>
                            <p>*Kami tunggu kedatangan anda.</p>
                            <?php } ?>
                            <!-- </form> -->
                            <div class="btn-black">
                                <button onclick="history.back()">
                                    Kembali
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/order_detail.svg" alt="">
                </div>
            </div>
        </div>
    </section>
    <?php }else{ ?>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Status Kemitraan
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <h3><b> Anda Belum Mengajukan Untuk Kemitraan</b></h3>
                    </div>
                    <div class="btn-box">
                        <a href="kemitraan.php" class="btn btn-warning">
                            Mulai Mengajukan Kemitraan
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/no_data.svg" alt="" width="450px">
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!--footer area-->
    <?php include 'includes/footer.php'; ?>

    <script>
        function validasifile2() {
            var file2 = document.getElementById("upload").files;
            var docx = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            var doc = "application/msword";
            for (var i = 0; i < file2.length; i++) {
                if (file2[i].type != 'application/pdf' && file2[i].type != docx && file2[i].type != doc) {
                    alert("format file hanya dapat .pdf, .doc dan .docx");
                    // document.getElementById("submit").disabled = true;
                    document.getElementById("upload").value = "";
                }
                if (file2[i].size > 5000000) {
                    alert("Ukuran file terlalu besar, anda tidak dapat mengupload file melebihi 5 MB");
                    document.getElementById("upload").value = "";
                }
            }


        }
    </script>