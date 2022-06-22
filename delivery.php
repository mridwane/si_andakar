<?php
session_start();
if (isset($_SESSION['C_ID'])) ?>
<?php include('includes/connection.php'); ?>
<?php $page = "Reservasi"; ?>
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
    </div>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Delivery
                </h2>
            </div>
            <!-- Informasi personal -->
            <form action="#" method="POST" class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <div>
                            <input type="text" class="form-control" placeholder="Your Name"
                                value="<?= $_SESSION['C_FNAME'] . ' ' . $_SESSION['C_LNAME'] ?>" disabled />
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Phone Number"
                                value="<?= $_SESSION['contact'] ?>" disabled />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Your Email"
                                value="<?= $_SESSION['email'] ?>" disabled />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form_container">
                        <div>
                            <input type="text" class="form-control" name="transac_code" value="<?= $_GET['nt'] ?>"
                                readonly />
                        </div>
                        <div>
                            <textarea class="form-control" name="" id="" cols="30" rows="4" readonly>
                                    <?= $_SESSION['address'] ?>
                                </textarea>
                        </div>
                        <div>
                            <span>Ingin merubah alamat dan data lainnya? <a href="profil.php">Rubah data</a></span>
                        </div>
                        <div class="btn-box">
                            <button type="submit">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="food_section layout_padding">
        <!-- Product Tables -->
        <div class="card mb-3">
            <div class="card-header">
                <Center>
                    <h3>Makanan/Minuman yang dipilih</h3>
                </Center>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Jenis</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = 'SELECT * FROM `tbltransacdetail` a inner join `tblproducts` b on a.`product_code` = b.`product_id` WHERE a.`transac_code` = "' . $_GET['nt'] . '"';
                                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    // membuat nomer otomatis untuk di tabel
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // cek Status Pending atau disetujui
                                        if ($row['status'] == "0") {
                                            $status = "Pending";
                                        } elseif ($row['status'] == "1") {
                                            $status = "Disetujui";
                                        } else {
                                            $status = "Dibatalkan";
                                        }
                                        echo '<tr>';
                                        echo '<td>' . $no++ . '</td>';
                                        echo '<td>' . $row['product_name'] . '</td>';
                                        echo '<td>' . $row['qty'] . '</td>';
                                        echo '<td>' . $row['type'] . '</td>';
                                        echo '<td><a type="button" class="btn-detail" data-toggle="modal"
                                                data-target="#cartReservasi"
                                        href="detail_list_permintaan.php?&no_permintaan=' . $row['transac_code'] . '">
                                            <span class="material-icons">
                                                Edit
                                            </span>
                                            </a>
                                            </td>';
                                        echo '</tr> ';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="cartReservasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Makanan Yang Dipesan Untuk Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/reservasi_controller.php?action=updatePesanan" method="POST">
                    <div class="modal-body">
                        <input type="text" class="form-control" name="transac_code" value="<?= $_GET['nt'] ?>" hidden />
                        <table class="show-cart table">

                        </table>
                        <div>Total price: Rp.<span class="total-cart" id="total_chart"></span></div>
                        <input type="text" class="jml_total" name="jml_total" id="jml_total" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="clear-cart btn btn-danger">Hapus List Menu</button>
                        <button type="submit" id="next_reservasi" name="next_reservasi" class="btn btn-primary">Update
                            Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>