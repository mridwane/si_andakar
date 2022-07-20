<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="">
                <img src="assets/images/logo.png" alt="" width="150px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if(empty($_SESSION['akses'])){ ?>
                <ul class="navbar-nav  mx-auto">
                    <li class="nav-item <?php if ($page == "Home") { echo "active"; } ?>">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Delivery"  || $page == "Delivery Checkout") {  echo "active"; } ?>">
                        <a class="nav-link" href="delivery_menu.php">Delivery</a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Reservasi"  || $page == "Reservasi Checkout") { echo "active"; } ?>">
                        <a class="nav-link" href="reservasi_menu.php">Reservasi</a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Catering" || $page == "Catering Checkout") { echo "active"; } ?>">
                        <a class="nav-link" href="catering_menu.php">Catering</a>
                    </li>
                    <li class="nav-item <?php if ($page == "Kemitraan") { echo "active"; } ?>">
                        <a class="nav-link" href="kemitraan.php">Kemitraan</a>
                    </li>
                </ul>
                <?php }elseif($_SESSION['akses'] == "Customer"){ ?>
                <ul class="navbar-nav  mx-auto">
                    <li class="nav-item <?php if ($page == "Home") { echo "active"; } ?>">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Delivery"  || $page == "Delivery Checkout") {  echo "active"; } ?>">
                        <a class="nav-link" href="delivery_menu.php">Delivery</a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Reservasi"  || $page == "Reservasi Checkout") { echo "active"; } ?>">
                        <a class="nav-link" href="reservasi_menu.php">Reservasi</a>
                    </li>
                    <li
                        class="nav-item <?php if ($page == "Catering" || $page == "Catering Checkout") { echo "active"; } ?>">
                        <a class="nav-link" href="catering_menu.php">Catering</a>
                    </li>
                </ul>
                <?php }elseif($_SESSION['akses'] == "Mitra"){ ?>
                <ul class="navbar-nav  mx-auto">
                    <li class="nav-item <?php if ($page == "Home") { echo "active"; } ?>">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?php if ($page == "Kemitraan") { echo "active"; } ?>">
                        <a class="nav-link" href="status_kemitraan.php">Kemitraan</a>
                    </li>
                </ul>
                <?php } ?>

                <div class="user_option">
                    <?php if ($page == "Reservasi") { ?>
                    <a class="cart_link" href="#" data-toggle="modal" data-jenis="<?= $page ?>" data-target="#cartMenu">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029"
                            style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                            c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                            C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                            c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                            C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>
                        <p class="text-yellow total-count"></p>
                    </a>
                    <?php } elseif($page == "Delivery") { ?>
                    <a class="cart_link" href="#" data-toggle="modal" data-jenis="<?= $page ?>" data-target="#cartMenu">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029"
                            style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                            c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                            C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                            c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                            C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>
                        <p class="text-yellow total-count"></p>
                    </a>
                    <?php } elseif($page == "Catering") { ?>
                    <a class="cart_link" href="#" data-toggle="modal" data-jenis="<?= $page ?>" data-target="#cartMenu">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029"
                            style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                            c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                            C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                            c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                            C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>
                        <p class="text-yellow total-count"></p>
                    </a>
                    <?php } else { ?>


                    <?php } ?>
                    <?php if (isset($_SESSION['cid'])) { ?>
                    <div class="dropdown show">
                        <a class="user_link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['C_FNAME'].' '. $_SESSION['C_LNAME'] ?>
                        </a>
                        <?php if ($page == "Kemitraan" || $page == "Status kemitraan") {
                            $cek = mysqli_query($db, 'SELECT C_ID FROM tblrequestmitra WHERE C_ID = "'.$_SESSION["cid"].'"');   
                            if ($cek->num_rows > 0) {
                        ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="profil.php">Profil</a>
                                <a class="dropdown-item" href="status_kemitraan.php">Status kemitraan</a>
                            </div>
                        <?php  } else {?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="profil.php">Profil</a>
                            </div>
                        <?php }} else { ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="profil.php">Profil</a>
                                <a class="dropdown-item" href="order.php">Pesanan Kamu</a>
                            </div>
                        <?php } ?>
                        
                    </div>
                    <a href="#" class="order_online" data-toggle="modal" data-target="#logoutModal">
                        Keluar
                    </a>
                    <?php } else{ ?>
                    <a href="register.php" class="user_link"><span>Register</span></a>
                    <a href="login.php" class="order_online"> Masuk </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- modal logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="includes/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>