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

    $query = 'SELECT regis_no, date_req, status, note FROM `tblrequestmitra` WHERE
    C_ID = "'.$_SESSION["cid"].'"';
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
    <?php if ($cek->num_rows > 0) {
            if($status == "denied"){
    ?>
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
                            <h3><b> Maaf Pengajuan anda kami tolak</b></h3>
                        </div>
                        <div class="btn-box">
                            <a href="kemitraan.php" class="btn btn-warning">
                                Mulai Mengajukan ulang Kemitraan
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="assets/images/denied.svg" alt="" width="450px">
                    </div>
                </div>
            </div>
        </section>
        <?php }else { ?>
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
                                <?php if ($status == "unconfirmed") { ?>
                                <span>Silahkan tunggu konfirmasi dari pihak admin.</span>

                                <?php }elseif($status == "denied") {?>
                                <span>Maaf pengajuan kemitraan anda kami tolak karena <b><?= $keterangan ?></b>.</span>
                                <br>

                                <?php }elseif($status == "interview") {?>
                                <span><b><?= $keterangan ?></b></span>

                                <?php }elseif($status == "active") {?>
                                <span><b><?= $keterangan ?></b></span>
                                <?php } ?>
                                <!-- </form> -->
                                <div class="btn-black">
                                    <button>
                                        <a href="kemitraan.php">
                                            Kembali
                                        </a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if ($status == "unconfirmed") { ?>
                        <img src="assets/images/status_menunggu.svg" alt="">
                        <?php }elseif($status == "denied") {?>
                        <img src="assets/images/status_ditolak.svg" alt="">
                        <?php }elseif($status == "interview") {?>
                        <img src="assets/images/interview.svg" alt="" width="550px">
                        <?php }elseif($status == "active") {?>
                        <img src="assets/images/status_diterima.svg" alt="">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
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