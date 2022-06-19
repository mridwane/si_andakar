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
                            <form action="" method="POST">
                                <div>
                                    <label for="upload">Upload Portofolio</label>
                                    <input type="file" class="form-control" id="upload" name="upload" accept=".pdf, .docx, .doc">
                                    <span>*File harus PDF/Word </span>
                                </div>
                                <button type="submit" id="update_reservasi" name="update_reservasi" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <?php } ?>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>