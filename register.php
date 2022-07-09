<?php $page = "Register"; ?>
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
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h3>
                    Register
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <?php 
                            if (isset($_GET['error'])) {
                                if ($_GET["error"]=="emptyfields") {
                                    echo '<p class="signuperror">Silahkan isi semua field</p>';
                                }
                                elseif ($_GET["error"]=="invalidmail") {
                                    echo '<p class="signuperror">Email Tidak Valid</p>';
                                }
                                elseif ($_GET["error"]=="invaliduid") {
                                    echo '<p class="signuperror">Username Tidak Valid</p>';
                                }
                                elseif ($_GET["error"]=="passwordcheck") {
                                    echo '<p class="signuperror">Password anda tidak cocok</p>';
                                }
                                elseif ($_GET["error"]=="usertaken") {
                                    echo '<p class="signuperror">Username sudah ada</p>';
                                }
                                elseif ($_GET["error"]=="emailtaken") {
                                    echo '<p class="signuperror">Email/Username sudah ada</p>';
                                }
                            } 
                            elseif (isset($_GET['register'])) {
                                if ($_GET["register"]=="success") {
                                echo '<p class="signupsuccess">Register Berhasil</p>';
                            }
                        }?>
                        <form action="includes/signup.php" method="post">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="firstName">Nama Pertama</label>
                                            <input type="text" id="firstName" name="C_FNAME" class="form-control"
                                                placeholder="First name" autofocus="autofocus">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="lastName">Nama Terakhir</label>
                                            <input type="text" id="lastName" name="C_LNAME" class="form-control"
                                                placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputage"> Umur</label>
                                            <input type="number" id="inputage" name="C_AGE" class="form-control"
                                                placeholder="Age">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputpnumber">Nomor HP</label>
                                            <input type="number" maxlength="11" id="inputpnumber" name="C_PNUMBER"
                                                class="form-control input-sm" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputpnumber">Jenis Kelamin</label>
                                            <select type="text" id="inputGender" name="C_GENDER" class="form-control"
                                                placeholder="Gender">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option>Laki-Laki</option>
                                                <option>Perempuan</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputpnumber">Akses</label>
                                            <select type="text" id="inputAkses" name="C_AKSES" class="form-control"
                                                placeholder="Akses">
                                                <option selected disabled>Pilih Sebagai Apa?</option>
                                                <option>Customer</option>
                                                <option>Mitra</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputEmail">Email</label>
                                            <input type="text" id="inputEmail" name="C_EMAILADD" class="form-control"
                                                placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputuser">Nama Pengguna</label>
                                            <input type="text" id="inputuser" name="username" class="form-control"
                                                placeholder="Username">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="inputPassword">Kata Sandi</label>
                                            <input type="password" id="inputPassword" name="password"
                                                class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                                            <input type="password" id="confirmPassword" name="pwdcon"
                                                class="form-control" placeholder="Confirm password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"
                                name="signups-submit">Registrasi</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <img src="images/login.svg" alt="" width="500px">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>