<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="css/tambahan.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/sb-new.css">
  </head>

  <body class="login">

   <div class="container">
     <div class="row">
       <div class="col-6">
          <div class="container">
            <div class="card card-login mx-auto mt-5">
              <div class="card-header text-dark"><h3> Masuk</h3></div>
              <div class="card-body">
              <?php session_start();
                if (isset($_GET['error'])) {
                  if ($_GET["error"]=="wrongpwd") {
                    echo '<p class="signuperror">Username/Password Salah!</p>';
                  }
                  
                  } 
                  
              
                ?>
                <form action="includes/signin.php" method="post">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="inputEmail" name="mailuid" class="form-control" placeholder="Email/Username" required autofocus="autofocus">
                      <label for="inputEmail">Email/Nama Pengguna</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" >
                      <label for="inputPassword">Kata Sandi</label>
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
                <div class="text-center">
                  <a class="d-block small mt-3" href="register.php">Registrasi</a>
                  <a class="d-block small mt-3" href="index.php">Beranda</a>
                </div>
              </div>
            </div>
          </div>
       </div>
       <div class="col-6 center-position">
         <img src="images/login.svg" alt="" width="300px">
       </div>
     </div>
   </div>

 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
