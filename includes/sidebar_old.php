<div class="container-fluid">
  <div class="row">
    <div class="col-2">
      <?php if (isset($_SESSION['cid'])) { ?>
      <div id="wrapper">
        <nav class="tinggi-sidebar">
          <ul class="sdbr">
            <li class="nav jarak-nav beranda-marker">
              <a class="center-position" style="text-decoration: none; color: #343A40" href="index.php">
                <span class="material-icons md-24">
                  home
                </span>
                <span class="text-menu">Beranda</span>
              </a>
            </li>
            <li class="nav jarak-nav produk-marker">
              <a class="center-position" style="text-decoration: none; color: #343A40" href="index.php">
                <span class="material-icons md-24">
                  store
                </span>
                <span class="text-menu">Produk</span>
              </a>
            </li>
            <?php $cart = isset($_SESSION['cart'])? count($_SESSION['cart']) : 0; ?>
            <li class="nav jarak-nav <?php if($page == "cart") echo "aktif";?>">
              <?php if (isset($_POST['add_to_cart'])) {
                  echo '
                  <a class="center-position" style="text-decoration: none; color: #343A40" href="cart.php">
                    <span class="material-icons md-24">
                      shopping_cart
                    </span>
                    <span class="text-menu">Keranjang</span>
                  </a>';
                }else{
                  echo '
                  <a class="center-position" style="text-decoration: none; color: #343A40" href="cart.php">
                    <span class="material-icons md-24">
                      shopping_cart
                    </span>
                    <span class="text-menu">Keranjang <span class="text-success">('.$cart.')</span></span>
                  </a>';
                }
                ?>
            </li>
            <li class="nav jarak-nav  <?php if($page == "daftar pesanan") echo "aktif";?>">
              <a class="center-position page-scroll" style="text-decoration: none; color: #343A40" href="order.php">
                <span class="material-icons md-24">
                  wysiwyg
                </span>
                <span class="text-menu">Daftar Pesanan</span>
              </a>
            </li>
            <img src="images/tanam.svg" class="img-sidebar" alt="">
          </ul>
        </nav>
      </div>
      <?php  }else{ ?>
      <div id="wrapper">
        <nav class="tinggi-sidebar">
          <ul class="sdbr">
            <li class="nav jarak-nav beranda-marker ">
              <a class="center-position page-scroll" style="text-decoration: none; color: #343A40" href="index.php">
                <span class="material-icons md-24">
                  home
                </span>
                <span class="text-menu">Beranda</span>
              </a>
            </li>

            <li class="nav jarak-nav produk-marker ">
              <a class="center-position page-scroll" style="text-decoration: none; color: #343A40" href="index.php">
                <span class="material-icons md-24">
                  store
                </span>
                <span class="text-menu">Produk</span>
              </a>
            </li>

            <li class="nav jarak-nav  <?php if($page == "cart") echo "aktif";?>">
              <a class="center-position" style="text-decoration: none; color: #343A40" href="cart.php">
                <span class="material-icons md-24">
                  shopping_cart
                </span>
                <span class="text-menu">Keranjang</span>
              </a>
            </li>
            <img src="images/tanam.svg" class="img-sidebar" alt="">
          </ul>
        </nav>
      </div>
      <?php } ?>
    </div>
    <!-- Sidebar -->