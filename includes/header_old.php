<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">

    <title> Andakar </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
      integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
      crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="assets/css/responsive.css" rel="stylesheet" />

  </head>

</head>

<body>

  <nav class="navbar navbar-expand menu-bar sticky-top bg-navbar">

    <h4 class="color-logo" style="text-decoration:none;">Purna Baja Harsco</h4>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="tombol">
        <?php 
          if (isset($_SESSION['cid'])) {
            echo '<a class="nav-link " href="admin.php"><span class="material-icons">
            person
            </span> '.$_SESSION['C_FNAME'].' '.$_SESSION['C_LNAME'].'</a>';
            
          }else{
            echo '<a class="nav-link " href="register.php">
            <span class="material-icons" >
            assignment
            </span> Registrasi</a>';
          }
        
        ?>
        <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div> -->
      </li>

      <li class="tombol">
        <?php 
     if (isset($_SESSION['cid'])) {
      echo '<a class="nav-link " href="#" data-toggle="modal" data-target="#logoutModal" ><span class="material-icons">
      power_settings_new
      </span> Keluar</a>';
     }else{
      echo '
          <a class="nav-link " href="login.php" id="userDropdown" ><span class="material-icons">
          login
          </span> Masuk</a>       
       ' ;
      

     }
      ?>

      </li>
    </ul>

  </nav>