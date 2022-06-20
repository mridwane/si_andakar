  <?php 
        if (isset($_SESSION['userid'])) {
          if ($_SESSION['position']=='Admin') { ?>
  <div id="wrapper">
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Beranda</span>
        </a>
      </li>
      <li class="nav-item">
        <a title="Admins" class="nav-link" href="user.php">
          <i class="fas fa-fw fa-user-secret"></i>
          <span>User</span></a>
      </li>
      <li class="nav-item">
        <a title="Customers" class="nav-link" href="customer.php">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>Pelanggan</span></a>
      </li>
      <li class="nav-item">
        <a title="Products" class="nav-link" href="product.php">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Menu</span></a>
      </li>
      <!-- <li class="nav-item">
        <a title="Products" class="nav-link" href="permintaan_barang.php">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Buat Permintaan Barang</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a title="Products" class="nav-link" href="list_permintaan_barang.php">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>List Permintaan Barang</span>
        </a>
      </li> -->
      <li class="nav-item">
        <a title="Transaction" class="nav-link" href="detail.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Transaksi</span></a>
      </li>
      <!-- <li class="nav-item">
        <a title="Reports" class="nav-link" href="reportpage.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Laporan Penjualan</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a title="Reports" class="nav-link" href="reportstock.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Laporan Penyetokan</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a title="Reports" class="nav-link" href="reportdelivery.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Laporan Pengiriman</span></a>
      </li> -->
    </ul>
    <?php }} ?>
    <div id="content-wrapper">
      <div class="container-fluid">

        <!-- Sidebar -->