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
                    PROFIL
                </h2>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <!-- <img src="assets/images/order_detail.svg" alt=""> -->
                    <nav class="nav flex-column nav-pills">
                        <a class="nav-link active" href="profil.php">Edit Profile</a>
                        <a class="nav-link" href="profil_alamat.php">Edit Alamat</a>
                        <!-- <a class="nav-link" href="#">Link</a> -->
                    </nav>
                </div>
                <div class="col-md-5">
                    <div class="form_container">
                        <form action="controller/profil_controller.php?action=update" method="POST">
                            <div>
                                <label for="">Nama Depan</label>
                                <input type="text" class="form-control" name="fname" value="<?= $FNAME ?>" />
                            </div>
                            <div>
                                <label for="">Nama Belakang</label>
                                <input type="text" class="form-control" value="<?= $LNAME ?>" name="lname" />
                            </div>
                            <div>
                                <label for="">No Whatsapp</label>
                                <input type="text" class="form-control" value="<?= $NOTLP ?>" name="nowa" />
                            </div>
                            <div>
                                <label for="">Email</label>
                                <input type="email" class="form-control" value="<?= $EMAIL ?>" name="email" />
                            </div>
                            <div class="btn-box">
                                <button type="submit">
                                    Update Profil
                                </button>
                            </div>
                        </form>
                        <div class="btn-black">
                            <button onclick="history.back()">
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/profil.svg" alt="" width="550px">
                </div>
            </div>
        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>