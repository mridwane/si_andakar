<?php
session_start();
if (isset($_SESSION['C_ID'])) ?>
<?php include('includes/connection.php'); ?>
<?php $page = "Reservasi Checkout"; ?>
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
                    Reservasi
                </h2>
            </div>
            <div class="row">
                <!-- Informasi personal -->
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
                <!-- Pengaturan reservasi -->
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="controller/reservasi_controller.php?action=save" method="POST">
                            <div>
                                <select class="form-control nice-select wide" id="person_count" name="person_count" required>
                                    <option value="" disabled selected> Untuk Berapa Orang? </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div>
                                <label for="date">Tanggal Reservasi?</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div>
                                <label for="time">Waktu Reservasi?</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Reservasi Sekarang
                            </button>
                        </form>
                        <form action="controller/reservasi_controller.php?action=cancel" method="POST">
                            <input type="text" class="form-control" name="kd_cart" value="<?= $_GET['kd_cart'] ?>"
                                hidden />
                            <div class="btn-red">
                                <button type="submit">Tidak Jadi Reservasi</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="food_section layout_padding">
        <!-- Product Tables -->
        <div class="container">
            <div class="card mb-3">
                <div class="card-header">
                    <Center>
                        <h3>Makanan/Minuman yang dipilih</h3>
                    </Center>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead class="table-primary">
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
                                $query = 'SELECT * FROM `tblcartdetail` a inner join `tblproducts` b on a.`kd_menu` = b.`product_id` inner join `tblsaus` c on a.`kd_saus` = c.`id_saus` WHERE a.`kd_cart` = "' . $_GET['kd_cart'] . '"';
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
                                    if (!empty($row['kematangan'])) {
                                        if ($row['id_saus'] == 'S100') {
                                        echo '<td>' . $row['product_name'] . '</td>';
                                        } else {
                                        echo '<td>' . $row['product_name'] . ' + ' . $row['nama_saus'] . ' ('.$row['kematangan'].')</td>';
                                        }
                                    }
                                    else {
                                        if ($row['id_saus'] == 'S100') {
                                        echo '<td>' . $row['product_name'] . '</td>';
                                        } else {
                                        echo '<td>' . $row['product_name'] . ' + ' . $row['nama_saus'] . '</td>';
                                        }
                                    }
                                    echo '<td>' . $row['qty'] . '</td>';
                                    echo '<td>' . $row['type'] . '</td>';
                                    echo '<td>Rp. ' . number_format($row['harga'] ,0,',','.'). '</td>';
                                    echo '</tr> ';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
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