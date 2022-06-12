<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';
?>
<style type="text/css">
  .error-msg {
    text-align: center;
    font-weight: bold;
  }
</style>
<div class="container">
  <div class="card card-register mx-auto mt-3">
    <div class="card-header">
      <center>
        <h3>Tambahkan Pengguna</h3>
      </center>
    </div>
    <div class="card-body">
      <?php 
          if (isset($_GET['error'])) {
            if ($_GET["error"]=="emptyfields") {
              echo '<p class="text-danger error-msg">Isi semua kolom</p>';
            }
            elseif ($_GET["error"]=="invalidmail") {
               echo '<p class="text-danger error-msg">Email tidak valid</p>';
            }
            elseif ($_GET["error"]=="invaliduid") {
               echo '<p class="text-danger error-msg">Nama pengguna tidak valid</p>';
            }
            elseif ($_GET["error"]=="passwordcheck") {
               echo '<p class="text-danger error-msg">Kata sandi Anda tidak cocok</p>';
            }
            elseif ($_GET["error"]=="usertaken") {
               echo '<p class="text-danger error-msg">Nama pengguna sudah diambil</p>';
            }
            elseif ($_GET["error"]=="emailtaken") {
               echo '<p class="text-danger error-msg">Email / Nama Pengguna sudah diambil</p>';
            }
            } 
             
         
           ?>
      <form action="theme/signup.php" method="post">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="text" id="firstName" name="firstname" class="form-control" placeholder="First name"
                  autofocus="autofocus">
                <label for="firstName">Nama Depan</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Last name">
                <label for="lastName">Nama Belakang</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputEmail" name="mail" class="form-control" placeholder="Email address">
            <label for="inputEmail">Email</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <select type="text" id="inputEmail2" name="pos" class="form-control" placeholder="Position">
              <option>Crew Restoran</option>
              <option>Admin Finance</option>
              <option>Operational Manajer</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="hidden" id="inputContact" name="con" class="form-control" placeholder="Email address">
            <label for="inputContact">Contact</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="hidden" id="inputAddress" name="addre" class="form-control" placeholder="Email address">
            <label for="inputAddress">Alamat</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputEmail1" name="uid" class="form-control" placeholder="User Name">
            <label for="inputEmail1">Nama Pengguna</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password">
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
        <button type="submit" class="btn btn-primary btn-block" name="signup-submit">Simpan</button>
      </form>
    </div>
  </div>
</div>
<!--footer area-->
<?php include 'theme/footer.php'; }?>