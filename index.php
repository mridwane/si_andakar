<?php 
session_start();
include('includes/connection.php');
$page = "Home";
include 'includes/header.php';
if (isset($_SESSION['cid']))
?>
<!--header area-->

<body>
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
                                            Selamat Datang di Andakar Steak
                                        </h1>
                                        <p>
                                            Andakar Steak memiliki menu yang bervariasi, diantaranya:
                                            Steak Sirloin, Tenderloin, Wagyu, Lamb Shank (Betis Domba), Barbar Rib, JC
                                            Rib, dan Tomahawk
                                            yang
                                            merupakan salah satu Menu Spesial yang disajikan Andakar Steak.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <ol class="carousel-indicators">
                        <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                        <li data-target="#customCarousel1" data-slide-to="1"></li>
                        <li data-target="#customCarousel1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>

        </section>
    </div>
    <section class="about_section layout_padding">
        <div class="container  ">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="assets/images/logo.png" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Tentang Kami
                            </h2>
                        </div>
                        <p>
                            Andakar Steak Mulai Dikenal Sejak Tahun 2007 sebagai Restoran Steak Keluarga Indonesia
                            yang memiliki olahan utama Daging Segar. Melalui bahan baku berkualitas dan teknik
                            panggangan
                            mutakhir, Andakar Steak mampu menghadirkan steak cita rasa terbaik dengan level steak
                            Internasional
                            dan harga yang terjangkau.
                        </p>
                        <p>
                            Andakar Steak memiliki menu yang bervariasi, diantaranya:
                            Steak Sirloin, Tenderloin, Wagyu, Lamb Shank (Betis Domba), Barbar Rib, JC Rib, dan Tomahawk
                            yang
                            merupakan salah satu Menu Spesial yang disajikan Andakar Steak.
                        </p>
                        <p>
                            Andakar Steak akan senantiasa memberikan yang terbaik kepada pelanggan melalui penyajian
                            produk
                            berkualitas tinggi serta pelayanan yang maksimal kepada setiap konsumen.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Galeri
                </h2>
            </div>

            <!-- <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                <li data-filter=".burger">Burger</li>
                <li data-filter=".pizza">Pizza</li>
                <li data-filter=".pasta">Pasta</li>
                <li data-filter=".fries">Fries</li>
            </ul> -->

            <div class="filters-content">
                <div class="row grid">
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (1).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (2).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (3).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (4).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (5).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (6).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (7).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (8).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="assets/images/galery/galery (9).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>