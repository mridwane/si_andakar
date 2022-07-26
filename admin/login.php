<?php 
if (isset($_POST['login-submit'])) {
 include('../includes/connection.php');

 $mailuid = $_POST['mailuid'];
 $pass = $_POST['pwd'];

if (empty($mailuid)||empty($pass)) {
  header("Location: login.php?error=emptyfields");
  exit();
}
else{
  $sql = "SELECT * FROM tblusers WHERE username=? OR email=?;";
  $stmt = mysqli_stmt_init($db);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
  header("Location: login.php?error=sqlerror");
  exit();
  }
  else{
    mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $pwdCheck = password_verify($pass,$row['pass']);
      if ($pwdCheck == false) {
      header("Location: login.php?error=wrongpwd");
      exit();
      }
      elseif ($pwdCheck == true) {
        session_start();
        $_SESSION['userid'] = $row['user_id'];
        $_SESSION['useruid'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['position'] = $row['position'];
        header("Location: index.php?login=success");
        exit();
      }
      else{
        header("Location: login.php?error=wrongpwd");
        exit();
      }
    }
    else{
      header("Location: login.php?error=nouser");
      exit();
    }
  }
}

}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/styles.css" rel="stylesheet" />
        <style>
          /* custom css */
          .bg-auth {
            position: fixed;
            width: 100%;
          }
        </style>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-warning">
      <img src="../assets/images/bg-auth.jpg" class="bg-auth" alt="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                      <?php session_start();
                                      if (isset($_GET['error'])) {
                                        if ($_GET["error"]=="wrongpwd") {
                                          echo '<p class="signuperror">Username/Password Salah!</p>';
                                        }
                                      }     
                                      ?>
                                        <form ction="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="mailuid" class="form-control" placeholder="Email/Username" required autofocus="autofocus"/>
                                                <label for="inputEmail">Email/Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input id="inputPassword" type="password" name="pwd" class="form-control" placeholder="Password" required/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" name="login-submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Belum Punya Akun? </a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
