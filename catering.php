<?php
session_start();
if (isset($_SESSION['C_ID'])) ?>
<?php include('includes/connection.php'); ?>
<?php $page = "Catering Checkout"; ?>
<!--header area-->
<?php include 'includes/header.php';
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
            <div class="heading_container heading_center">
                <h2>
                    Catering
                </h2>
            </div>
            <!-- Informasi personal -->
            <form action="controller/catering_controller.php?action=save&kd_cart=<?= $_GET['kd_cart'] ?>" method="POST" class="row">
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
                <div class="col-md-6">
                    <div class="form_container">
                        <label for="date">Alamat</label>
                        <div>
                            <?php
                            $query = 'SELECT * FROM `tblcustomer`a JOIN `tblalamat`b ON a.C_ADRESSID=b.id_alamat WHERE a.C_ID = "' . $_SESSION["cid"] . '"';
                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $alamat = $row['alamat'];
                            }
                            ?>
                            <?php

                            $query = 'SELECT C_ADRESSID FROM `tblcustomer` WHERE C_ID = "' . $_SESSION["cid"] . '"';
                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            while ($row = mysqli_fetch_assoc($result)) {
                                $address = $row['C_ADRESSID'];
                            }
                            if ($address == 0) { ?>
                                <textarea name="" id="" cols="30" rows="4" disabled>Anda belum memilih alamat</textarea>
                            <?php } else { ?>
                                <textarea name="" id="" cols="30" rows="4" disabled><?= $alamat; ?></textarea>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="date">Tanggal Catering?</label>
                            <input type="datetime-local" class="form-control" id="date" name="date" onchange="validateDate(this)" required>
                        </div>
                        <div class="btn-box">
                            <button type="submit" id="pesan_catering" name="pesan_catering" class="btn btn-primary">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="food_section">
        <!-- Product Tables -->
        <div class="container">
            <div class="card mb-3">
                <div class="card-header">
                    <Center>
                        <h3>Makanan/Minuman yang dipilih</h3>
                    </Center>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="table-primary">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <!-- <th>Edit</th> -->
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
                                        if ($row['id_saus'] == 'S100') {
                                            echo '<td>' . $row['product_name'] . '</td>';
                                        } else {
                                            echo '<td>' . $row['product_name'] . ' + ' . $row['nama_saus'] . '</td>';
                                        }
                                        echo '<td>' . $row['qty'] . '</td>';
                                        echo '<td>' . $row['type'] . '</td>';
                                        echo '<td>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</td>';
                                        // echo '<td><a type="button" class="btn-detail" data-toggle="modal"
                                        //         data-target="#cartReservasi"
                                        // href="detail_list_permintaan.php?&no_permintaan=' . $row['transac_code'] . '">
                                        //     <span class="material-icons">
                                        //         Edit
                                        //     </span>
                                        //     </a>
                                        //     </td>';
                                        echo '</tr> ';
                                    }
                                    ?>
                                    <!-- <tr class="table-warning">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>
                                            Rp. 100.000
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="cartReservasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" name="transac_code" value="<?= $_GET['kd_cart'] ?>" hidden />
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

    <script>
        $('#date').on('change', function() {
            var selected_date = $(this).val();
            var today = new Date();
            var formattedDate = moment(date).format('YYYYMMDD');
            alert(selected_dat)
        });

        function validateDate(date) {
            var selectedDate = date.value;
            var parseDate = new Date(selectedDate)
            var today = new Date();
            let timeDifference = parseDate.getTime() - today.getTime();
            let dayDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
            var cek = true;
            if (dayDifference < 2) {
                alert("Minimal Tanggal Catering H+2 dari tanggal saat ini")
                document.getElementById("pesan_catering").disabled = true;
                cek = false
            } else {
                document.getElementById("pesan_catering").disabled = false;
                cek = true
            }

            if (cek == true) {
                if (parseDate.getHours() < 11 || parseDate.getHours() > 21) {
                    alert("Jam yang anda pilih berada di luar jam operasional kami, silahkan pilih jam diantar 11.00-21.00")
                    document.getElementById("pesan_catering").disabled = true;
                } else {
                    document.getElementById("pesan_catering").disabled = false;
                }
            }

        }
    </script>