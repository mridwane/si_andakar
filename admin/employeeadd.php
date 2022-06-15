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
  .error-msg{
  text-align: center;
  font-weight: bold;
}
</style>
<div class="container">
  <div class="card card-register mx-auto mt-3">
        <div class="card-header"><center><h3>Tambah Karyawan</h3></center></div>
        <div class="card-body">
 <form role="form" method="post" action="employeecontroller.php?action=add">
    <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"]=="firstname") {
              echo '<p class="error-msg text-danger">Nama depan wajib diisi</p>';
            }elseif ($_GET["required"]=="contacttaken") {
               echo '<p class="error-msg text-danger">Nomor Kontak sudah ada</p>';
            }elseif ($_GET["required"]=="lastname") {
               echo '<p class="error-msg text-danger">Nama belakang wajib diisi</p>';
            }elseif ($_GET["required"]=="number") {
               echo '<p class="error-msg text-danger">Diperlukan nomor kontak</p>';
            }elseif ($_GET["required"]=="invalidnumber") {
               echo '<p class="error-msg text-danger">Silakan Masukkan Nomor Kontak 11 digit Anda</p>';
            }elseif ($_GET["required"]=="email") {
               echo '<p class="error-msg text-danger">Diperlukan email</p>';
            }elseif ($_GET["required"]=="address") {
               echo '<p class="error-msg text-danger">Diperlukan alamat</p>';
            }elseif ($_GET["required"]=="gender") {
               echo '<p class="error-msg text-danger">Diperlukan jenis kelamin</p>';
            }elseif ($_GET["required"]=="age") {
               echo '<p class="error-msg text-danger">Diperlukan umur</p>';
            }elseif ($_GET["required"]=="position") {
               echo '<p class="error-msg text-danger">Posisi diperlukan</p>';
            }elseif ($_GET["required"]=="hire") {
               echo '<p class="error-msg text-danger">Tanggal sewa diperlukan</p>';
            } 
            }?>                        
          <div class="form-group">
          <input class="form-control" placeholder="Nama Depan" name="fname" autofocus="autofocus">
          </div>
          <div class="form-group">
          <input class="form-control" placeholder="Nama Belakang" name="lname">
          </div> 
          <div class="form-group">
          <input type="number"  class="form-control" placeholder="Phone number" name="numbers">
          </div> 
          <div class="form-group">
          <input class="form-control" placeholder="Email" name="email">
          </div> 
          <div class="form-group">
          <input  class="form-control" placeholder="Alamat" name="address">
          </div> 
          <div class="form-group">
          <select class="form-control" name="gender">
          <option disabled selected>Jenis Kelamin</option>
          <option>Laki-Laki</option>
          <option>Perempuan</option>
          <option>Lainnya</option>
          </select>
          </div> 
          <div class="form-group">
          <input type="number" class="form-control" placeholder="Umur" name="age">
          </div> 
          <div class="form-group">
          <input class="form-control" placeholder="Posisi" name="position">
          </div> 
          <div class="form-group">
          <input type="date" class="form-control" placeholder="Waktu Sewa" name="hire">
          </div> 
          <button type="submit" name="submit" class="btn btn-info">Simpan Rekam</button>
          <button type="reset" class="btn btn-danger">Kosongkan</button>


                      </form>  
                       </div>
                </div>
              </div>
       <?php include 'theme/footer.php'; }?>