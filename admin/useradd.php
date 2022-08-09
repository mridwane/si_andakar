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
                <input type="text" id="firstName" name="C_FNAME" class="form-control" placeholder="First name"
                  autofocus="autofocus" required>
                <label for="firstName">Nama Depan</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="text" id="lastName" name="C_LNAME" class="form-control" placeholder="Last name" required>
                <label for="lastName">Nama Belakang</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="number" maxlength="11" id="inputpnumber" name="C_PNUMBER" class="form-control"
              placeholder="Phone Number" required>
            <label for="inputpnumber">Nomor HP</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <select type="text" id="inputGender" name="C_ROLE" class="form-control" placeholder="Posisi" required>
              <option value="" selected disabled>Pilih Posisi</option>
              <option>Crew</option>
              <option>Admin Finance</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputEmail" name="C_EMAILADD" class="form-control" placeholder="Email Address"
              required>
            <label for="inputEmail">Alamat Email</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required>
            <label for="inputuser">Nama Pengguna</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                  required>
                <label for="inputPassword">Kata Sandi</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="password" id="confirmPassword" name="pwdcon" class="form-control"
                  placeholder="Confirm password" required>
                <label for="confirmPassword">Konfirmasi Kata Sandi</label>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="signups-submit">Registrasi</button>
      </form>
    </div>
  </div>
</div>
<!--footer area-->
<?php include 'theme/footer.php'; }?>