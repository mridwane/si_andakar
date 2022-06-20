<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); /* Redirect browser */
    exit();
} else { ?>
    <?php include('includes/connection.php'); ?>
    <?php $page = "Kemitraan"; ?>
    <!--header area-->
    <?php include 'includes/header.php'; ?>


    <body class="sub_page">
        <div class="hero_area">
            <div class="bg-box">
                <img src="assets/images/hero-bg.jpg" alt="">
            </div>
            <!-- navigation strats -->
            <?php include 'includes/navigation.php'; ?>
            <!-- end navigation-->
            <section class="slider_section">
                <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                        <div class="detail-box">
                                            <h1>
                                                Hi, Calon Mitra
                                            </h1>
                                            <p>
                                                Untuk format persyaratan kemtiraan dengan kami bisa didownload disini.
                                            </p>
                                            <div class="btn-box">
                                                <a href="assets/file/FORM PENDAFTARAN KEMITRAAN.pdf" class="btn1" target="_blank">
                                                    Download Format Persyaratan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <section class="book_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Kemitraan
                    </h2>
                </div>
                <div class="row">
                    <!-- Informasi personal -->
                    <div class="col-md-6">
                        <div class="form_container">

                            <div>
                                <input type="text" class="form-control" placeholder="Your Name" value="<?= $_SESSION['C_FNAME'] . ' ' . $_SESSION['C_LNAME'] ?>" disabled />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Phone Number" value="<?= $_SESSION['contact'] ?>" disabled />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Your Email" value="<?= $_SESSION['email'] ?>" disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Pengaturan reservasi -->

                    <div class="col-md-6">
                        <div class="form_container">
                            <form action="controller/kemitraan_controller.php" method="POST" enctype="multipart/form-data">
                                <div>
                                    <label for="upload">Upload Portofolio</label>
                                    <input type="file" class="form-control" id="upload" name="upload" onchange="validasifile2()" accept=".pdf, .docx, .doc">
                                    <span>*File harus PDF/Word, max 5 MB </span>
                                </div>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
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