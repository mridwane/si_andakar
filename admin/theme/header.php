<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Purna Baja Harsco - Admin</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <!-- icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/cart_style.css" rel="stylesheet">

  <!-- font tambahan -->

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

</head>

<style>
  .bungkus-tombol {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .bungkus-tombol a {
    text-decoration: none;
  }

  .btn-detail {
    display: flex;
    justify-content: center;
    background-color: #fb7813;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    width: 50px;
    margin: 5px;
    padding: 5px 0 5px 0;
  }

  .btn-detail :hover {
    color: black;
    transition: 1s;
    text-decoration: none;
  }

  .btn-cancel {
    display: flex;
    justify-content: center;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    width: 50px;
    margin: 5px;
    padding: 5px 0 5px 0;
  }

  .btn-cancel :hover {
    color: white;
    transition: 1s;
    text-decoration: none;
  }

  .btn-confirm {
    display: flex;
    justify-content: center;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    width: 50px;
    margin: 5px;
    padding: 5px 0 5px 0;
  }

  .btn-confirm :hover {
    color: white;
    transition: 1s;
    text-decoration: none;
  }
</style>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Purna Baja Harsco</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <!-- <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> -->

        <?php 
     if (isset($_SESSION['userid'])) {
       if ($_SESSION['position']=='Admin'){
      echo '<a class="nav-link " href="admin.php"><i class=" fas fa-user-circle" >'.$_SESSION['fname'].' '.$_SESSION['lname'].'</i></a>';
      }
     }else{
      echo '<a class="nav-link " href="admin.php"><i class="fas fa-user-alt ">Caren Bautista</i></a>';
     }
      ?>




        </a>
        <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div> -->
      </li>


      <a class="nav-link " href="#" data-toggle="modal" data-target="#logoutModal"><i
          class=" fas fa-sign-out-alt">Keluar</i></a>




    </ul>

  </nav>