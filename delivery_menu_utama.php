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
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Menu Steak
                </h2>
            </div>
            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                <li data-filter=".Steak">Steak</li>
                <li data-filter=".Ribs">Ribs</li>
                <li data-filter=".pasta">Pasta</li>
                <li data-filter=".fries">Fries</li>
                <li data-filter=".Saus">Saus</li>
            </ul>

            <div class="filters-content">
                <div class="row allMenu">
                    <?php 
                        $query = "SELECT * FROM tblproducts a Join tblcategory b WHERE a.category_id = b.category_id AND type = 'Makanan Utama'";
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));                        
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-sm-6 col-lg-4 all <?= $row['category'] ?>">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="admin/images/<?= $row['image'] ?>" alt="">
                                </div>
                                <div class="detail-box">
                                    <input type="text" id="prod_name" value="<?= $row['product_name'] ?> " hidden>
                                    <h5> <?= $row['product_name'] ?> </h5>
                                    <p> <?= $row['detail_product'] ?> </p>
                                    <div class="options">
                                        <h3> <b> Rp. <?=  number_format($row['price'],0,',','.'); ?> </b> </h3>
                                        <?php if($row['status'] == "Tersedia") { ?>
                                        <a href="#" data-toggle="modal"
                                            data-target="#modalMenu<?= $row['product_id'] ?>" class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                        </a>
                                        <?php }else { ?>
                                        <button class="btn btn-danger"><?= $row['status'] ?></button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal menu saus -->
                    <div class="modal fade" id="modalMenu<?= $row['product_id'] ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pesan
                                        <?= $row['product_name'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <span>
                                                <?= $row['product_name'] ?>
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number"
                                                        data-type="minus" data-field="quant[2]">-
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[2]" class="form-control input-number qty"
                                                    value="1" min="1" max="1000" disabled>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-number"
                                                        data-type="plus" data-field="quant[2]">+
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mx-auto">
                                            <h6><b>Pilih Saus</b></h6>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-control nice-select wide">
                                                <option value="" selected disabled>Pilih Saus</option>
                                                <?php 
                                                    $query2 = "SELECT * FROM tblsaus";
                                                    $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));   
                                                    while ($item = mysqli_fetch_assoc($result2)) {
                                                    
                                                ?>
                                                <option data-prices="<?= $item['harga_saus'] ?>"
                                                    data-id="<?= $item['id_saus'] ?>"
                                                    data-pricem="<?= $row['price'] ?>">
                                                    <?= $item['nama_saus'] ?>
                                                </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <div class="float-right">
                                                <p>Harga Saus: <span id="hargaSaus">0</span></p>
                                                <!-- <input type="text" id="hargaMenu" value="<?= $row['price'] ?>"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary addCart"
                                        data-kd-menu="<?= $row['product_id']; ?>" data-kd-saus="S100"
                                        data-price="<?= $row['price']; ?>" data-jenis="<?= $page ?>"
                                        data-fungsi="addMenu" data-qty="1" disabled>Masukan kedaftar pesanan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>



    <!-- modal cart menu -->
    <div class="modal fade" id="cartMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Pesanan Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="show-cart table">

                    </table>
                    <div>Total price: Rp.<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="clear-cart btn btn-danger">Hapus List Menu</button>
                    <a href="delivery_menu_sidedish.php" type="button" class="btn btn-primary">Pilih Menu Pendamping</a>
                </div>
            </div>
        </div>
    </div>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>