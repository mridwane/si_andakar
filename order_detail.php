<?php
    session_start();
    if(!isset($_SESSION["cid"])){
    header("Location: login.php");
    }else{
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Detail Order"; 
    include 'includes/header.php';
    }

    $query = 'SELECT * FROM `tbltransac` WHERE transac_code = "'.$_GET["no_transaksi"].'"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    // membuat nomer otomatis untuk di tabel
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $jenis = $row['transac_type'];
        // cek Status Pending atau disetujui atau batal
        if ($row['status'] == "0") {
            $status = "Pending";
        } elseif ($row['status'] == "1") {
            $status = "Disetujui";
        } else {
            $status = "Dibatalkan";
        }
        $total = $row['total_price'];

    }
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
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Detail Pesanan
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="">
                            <div>
                                <label for="">No Transaksi</label>
                                <input type="text" class="form-control" value="<?= $_GET['no_transaksi'] ?>" readonly />
                            </div>
                            <div>
                                <label for="">Jenis Pesanan</label>
                                <input type="text" class="form-control" value="<?= $jenis ?>" readonly />
                            </div>
                            <div>
                                <label for="">Status</label>
                                <input type="text" class="form-control" value="<?= $status ?>" readonly />
                            </div>
                            <div>
                                <label for="">Total Pesanan</label>
                                <input type="text" class="form-control" value="<?= $total ?>" readonly />
                            </div>
                            <!-- <div class="btn_box">
                                <button>
                                    Book Now
                                </button>
                            </div> -->
                        </form>
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