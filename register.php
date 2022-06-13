<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="css/tambahan.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/sb-new.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-6 center-position">
        <img src="images/register.svg" alt="" width="500px">
      </div>
      <div class="col-6">
        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header">Registrasi</div>
            <div class="card-body">
              <?php 
                session_start();
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
                  if (isset($_GET['register'])) {
                    if ($_GET["register"]=="success") {
                    echo '<p class="signupsuccess">Register Berhasil</p>';
                  }
              }
              
                ?>
              <form action="includes/signup.php" method="post">
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="text" id="firstName" name="C_FNAME" class="form-control" placeholder="First name"
                          autofocus="autofocus">
                        <label for="firstName">Nama Pertama</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="text" id="lastName" name="C_LNAME" class="form-control" placeholder="Last name">
                        <label for="lastName">Nama Terakhir</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" id="inputage" name="C_AGE" class="form-control" placeholder="Age">
                    <label for="inputage"> Umur</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="inputAddress" name="C_ADDRESS" class="form-control" placeholder="address">
                    <label for="inputAddress">Alamat</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" maxlength="11" id="inputpnumber" name="C_PNUMBER" class="form-control input-sm"
                      placeholder="Phone Number">
                    <label for="inputpnumber">Nomor HP</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <select type="text" id="inputGender" name="C_GENDER" class="form-control" placeholder="Gender">
                      <option>Laki-Laki</option>
                      <option>Perempuan</option>
                      <option>Lainnya</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="inputEmail" name="C_EMAILADD" class="form-control"
                      placeholder="Email Address">
                    <label for="inputEmail">Email</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username">
                    <label for="inputuser">Nama Pengguna</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="password" id="inputPassword" name="password" class="form-control"
                          placeholder="Password">
                        <label for="inputPassword">Kata Sandi</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-label-group">
                        <input type="password" id="confirmPassword" name="pwdcon" class="form-control"
                          placeholder="Confirm password">
                        <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="signups-submit">Registrasi</button>
              </form>
              <div class="text-center">
                <!--   <a class="d-block small mt-3" href="login.php">Login</a> -->
                <a class="d-block small mt-3" href="#" onclick="history.back()">Kembali</a>
              </div>
            </div>
          </div>
        </div>
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