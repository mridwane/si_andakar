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
  <div class="card card-register mx-auto mt-5">
      <div class="card-header">
        <center><h3>Tambahkan Pemasok</h3></center>
      </div>

        <div class="card-body">
  <form role="form" method="post" action="suppliercontroller.php?action=add">
                <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"]=="name") {
              echo '<p class="error-msg text-danger"> Nama pemasok harus diisi</p>';
            }elseif ($_GET["required"]=="contact") {
               echo '<p class="error-msg text-danger"> Kontak harus diisi</p>';
            }elseif ($_GET["required"]=="email") {
               echo '<p class="error-msg text-danger"> Email harus diisi</p>';
            }elseif ($_GET["required"]=="address") {
               echo '<p class="error-msg text-danger"> Alamat harus diisi</p>';
            } 
            }      ?>
                            <div class="form-group">
                              <input class="form-control" placeholder="Nama Pemasok" name="supplier" autofocus="autofocus">
                            </div>
                            <div class="form-group">
                              <input  type="number" maxlength="11" class="form-control" placeholder="Kontak" name="contact">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Email" name="email">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Alamat" name="address">
                            </div> 
                             
                            <button type="submit" name="submit" class="btn btn-info">Simpan Perubahan</button>
                            <button type="reset" class="btn btn-danger">Kosongkan</button>


                      </form>  
                       </div>
                </div>
              </div>


                                <?php include 'theme/footer.php'; }?>