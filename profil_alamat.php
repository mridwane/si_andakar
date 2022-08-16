<?php
    session_start();
    if(!isset($_SESSION["cid"])){
    header("Location: login.php");
    }else{
    include('includes/connection.php');
    // if (isset($_SESSION['C_ID']))
    $page = "Profil"; 
    include 'includes/header.php';
    }

    $query = 'SELECT * FROM `tblcustomer` WHERE C_ID = "'.$_SESSION["cid"].'"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
        $FNAME = $row['C_FNAME'];
        $LNAME = $row['C_LNAME'];
        $NOTLP = $row['C_PNUMBER'];
        $EMAIL = $row['C_EMAILADD'];
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
                    ALAMAT
                </h2>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <!-- <img src="assets/images/order_detail.svg" alt=""> -->
                    <nav class="nav flex-column nav-pills">
                        <a class="nav-link" href="profil.php">Edit Profile</a>
                        <a class="nav-link active" href="profil_alamat.php">Pilih Alamat</a>
                        <!-- <a class="nav-link" href="#">Link</a> -->
                    </nav>
                </div>
                <div class="col-md-5">
                    <?php 
                    $cid = $_SESSION['cid'];
                    $query = mysqli_query($db, 'SELECT * FROM tblalamat WHERE c_id = "'.$cid.'"');
                    $cek = mysqli_num_rows($query);

                    if($cek >= 5){
                    ?>
                    <button type="submit" class="btn btn-secondary" disabled>
                        Jumlah alamat anda sudah 5
                    </button>
                    <?php }else{ ?>
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#addAlamat">
                        Tambahkan Alamat
                    </button>
                    <?php } ?>
                    <br>
                    <br>
                    <div class="">
                        <form action="controller/profil_controller.php?action=save_address" method="POST">
                            <?php 
                                $query = 'SELECT * FROM `tblalamat` WHERE c_id = "'.$_SESSION["cid"].'"';
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $query1 = 'SELECT * FROM `tblcustomer` WHERE c_id = "'.$_SESSION["cid"].'"';
                                    $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));
                                    $cek = mysqli_fetch_assoc($result1);
                            ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="select_alamat" value="<?= $row['id_alamat']; ?>"
                                            <?php if($cek['C_ADRESSID'] == $row['id_alamat']){ echo 'checked=checked'; } ?>>
                                    </div>
                                    <textarea cols="30" rows="4" disabled><?= $row['alamat']; ?></textarea>
                                    <div class="input-group-text">
                                        <a type="submit" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editAlamat<?= $row['id_alamat']; ?>">
                                            Edit
                                        </a>
                                        <a href="controller/profil_controller.php?action=delete_address&id=<?= $row['id_alamat']; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="btn-box">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Alamat
                                </button>
                                <?php if(isset($_SESSION['page'])){ ?>
                                    <?php if($_SESSION['page'] == "Catering"){ ?>
                                    <a href="catering.php?kd_cart=Catering<?= $_SESSION['cid'] ?>" class="btn btn-dark">Kembali</a>
                                    <?php } elseif($_SESSION['page'] == "Delivery"){ ?>
                                    <a href="delivery.php?kd_cart=Delivery<?= $_SESSION['cid'] ?>" class="btn btn-dark">Kembali</a>
                                    <?php } else { ?>
                                    <a href="profil.php" class="btn btn-dark">Kembali</a>
                                    <?php } ?>
                                <?php }else { ?>
                                <a href="profil.php" class="btn btn-dark">Kembali</a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/address.svg" alt="" width="450px">
                </div>
            </div>
        </div>
    </section>

    <?php 
        $query = 'SELECT * FROM `tblalamat` WHERE c_id = "'.$_SESSION["cid"].'"';
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <!-- modal edit alamat -->
    <div class="modal fade" id="editAlamat<?= $row['id_alamat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/profil_controller.php?action=edit_address&id=<?= $row['id_alamat']; ?>"
                    method="POST">
                    <div class="modal-body">
                        <div>
                            <textarea name="address" id="" cols="30" rows="5" class="form-control"
                                placeholder="Input Alamat" required><?= $row['alamat']; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- modal add alamat -->
    <div class="modal fade" id="addAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/profil_controller.php?action=add_address" method="POST">
                    <div class="modal-body">
                        <div>
                            <textarea name="address" id="" cols="30" rows="5" class="form-control"
                                placeholder="Input Alamat" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>