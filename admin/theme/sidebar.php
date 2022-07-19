<?php 
if (isset($_SESSION['userid'])) { ?>

<div id="wrapper">
  <ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-home"></i>
        <span>Beranda</span>
      </a>
    </li>
    <?php if ($_SESSION['position']=='Admin Master') { ?>
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
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Menu</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <!-- <h6 class="dropdown-header">Login Screens:</h6> -->
        <a class="dropdown-item" href="product.php">Makanan/Minuman</a>
        <a class="dropdown-item" href="product_saus.php">Saus</a>
      </div>
    </li>
    <li class="nav-item">
      <a title="Kemitraan" class="nav-link" href="list_kemitraan_admin.php">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Kemitraan</span></a>
    </li>
    <li class="nav-item">
      <a title="Kemitraan" class="nav-link" href="pos.php">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Dinein</span></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Transaksi</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <!-- <h6 class="dropdown-header">Login Screens:</h6> -->
        <a class="dropdown-item" href="transaksi_semua.php">Semua</a>
        <a class="dropdown-item" href="transaksi_belum_diproses.php">Belum diproses</a>
        <a class="dropdown-item" href="transaksi_diproses.php">Diproses</a>
        <a class="dropdown-item" href="transaksi_selesai.php">Selesai</a>
      </div>
    </li>
    <li class="nav-item">
      <a title="Reports" class="nav-link" href="reportpage.php">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Laporan Penjualan</span></a>
    </li>
    <li class="nav-item">
      <a title="Reports" class="nav-link" href="reportcatering.php">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Laporan Catering</span></a>
    </li>

    <?php }elseif($_SESSION['position']=='Crew'){ ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Menu</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <!-- <h6 class="dropdown-header">Login Screens:</h6> -->
        <a class="dropdown-item" href="product.php">Makanan/Minuman</a>
        <a class="dropdown-item" href="product_saus.php">Saus</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Transaksi</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <!-- <h6 class="dropdown-header">Login Screens:</h6> -->
        <a class="dropdown-item" href="transaksi_semua.php">Semua</a>
        <a class="dropdown-item" href="transaksi_belum_diproses.php">Belum diproses</a>
        <a class="dropdown-item" href="transaksi_diproses.php">Diproses</a>
        <a class="dropdown-item" href="transaksi_selesai.php">Selesai</a>
      </div>
    </li>
    <li class="nav-item">
      <a title="Kemitraan" class="nav-link" href="pos.php">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Dinein</span></a>
    </li>
    <?php }elseif($_SESSION['position']=='Admin Finance'){ ?>
    <li class="nav-item">
      <a title="Reports" class="nav-link" href="reportpage.php">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Laporan Penjualan</span></a>
    </li>
    <li class="nav-item">
      <a title="Reports" class="nav-link" href="reportcatering.php">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Laporan Catering</span></a>
    </li>

    <?php }elseif($_SESSION['position']=='Oprational Manager'){ ?>
    <li class="nav-item">
      <a title="Kemitraan" class="nav-link" href="list_kemitraan_admin.php">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Kemitraan</span></a>
    </li>

    <?php } }?>
  </ul>
  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Sidebar -->