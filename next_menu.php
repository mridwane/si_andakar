<?php
session_start();
if (isset($_SESSION['C_ID'])) ?>
<?php include('includes/connection.php'); ?>
<?php $page = "Menu"; ?>
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
                        <form action="controller/reservasi_controller.php?action=update" method="POST">
                            <div>
                                <input type="text" class="form-control" name="transac_code" value="<?= $_GET['nt'] ?>"
                                    readonly />
                            </div>
                            <div>
                                <!-- <label for="person_count">Untuk Berapa Orang?</label> -->
                                <select class="form-control nice-select wide" id="person_count" name="person_count">
                                    <option value="" selected disabled>Untuk Berapa Orang?</option>
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
                                <!-- <input type="text" class="form-control" id="person_count" name="person_count"> -->
                            </div>
                            <div>
                                <label for="date">Tanggal Reservasi?</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div>
                                <label for="time">Waktu Reservasi?</label>
                                <input type="time" class="form-control" id="time" name="time">
                            </div>
                            <!-- <div class="btn_box" data-target="pilihMenu">
                            <button>
                                Pilih Menu
                            </button>
                        </div> -->
                            <button type="submit" id="update_reservasi" name="update_reservasi"
                                class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>

            </div>
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
                                        echo '<td><a type="button" class="btn-detail"
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

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>