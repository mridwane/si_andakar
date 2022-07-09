<?php $page = "Login"; ?>
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
                    Login
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <form action="includes/signin.php" method="post">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inputEmail">Email/Nama Pengguna</label>
                                    <input type="text" id="inputEmail" name="mailuid" class="form-control"
                                        placeholder="Email/Username" required autofocus="autofocus">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inputPassword">Kata Sandi</label>
                                    <input type="password" id="inputPassword" name="pwd" class="form-control"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="remember-me">
                                        Ingat Kata Sandi
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" name="login-submit">Masuk</button>
                        </form>
                    </div>
                    <div class="col-8">
                        <img src="images/login.svg" alt="" width="600px">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>