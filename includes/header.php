<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Purna Baja Harsco</title>

  <!-- Css Tambahan -->
  <link rel="stylesheet" href="css/tambahan.css">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;800&display=swap" rel="stylesheet">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/cart_style.css" rel="stylesheet">

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