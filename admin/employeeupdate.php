<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';

$query = 'SELECT * FROM `tblemployee` WHERE `EMP_ID` = '.$_GET['id'].' ';
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
               $id = $row['emp_id'];
               $fname = $row['fname'];
               $lname = $row['lname'];
               $number = $row['contact'];
               $email = $row['email'];
               $address = $row['address'];
               $gender = $row['gender'];
               $age = $row['age'];
               $position = $row['position'];
               $hire = $row['hire_date'];
              } 
?>  
<style type="text/css">
  .error-msg{
  text-align: center;
  font-weight: bold;
}
</style>
<div class="container">
  <div class="card card-register mx-auto mt-3">
        <div class="card-header"><center><h3>Perbaharui Karyawan</h3></center></div>
        <div class="card-body">
 <form role="form" method="post" action="employeecontroller.php?action=update">
    <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"]=="firstname") {
              echo '<p class="error-msg text-danger">Nama depan wajib diisi</p>';
            }elseif ($_GET["required"]=="lastname") {
               echo '<p class="error-msg text-danger">Nama belakang wajib diisi</p>';
            }elseif ($_GET["required"]=="number") {
               echo '<p class="error-msg text-danger">Kontak wajib diisi</p>';
            }elseif ($_GET["required"]=="email") {
               echo '<p class="error-msg text-danger">Email  wajib diisi</p>';
            }elseif ($_GET["required"]=="address") {
               echo '<p class="error-msg text-danger">Alamat wajib diisi</p>';
            }elseif ($_GET["required"]=="gender") {
               echo '<p class="error-msg text-danger">Jenis kelamin wajib diisi</p>';
            }elseif ($_GET["required"]=="age") {
               echo '<p class="error-msg text-danger">Umur wajib diisi</p>';
            }elseif ($_GET["required"]=="position") {
               echo '<p class="error-msg text-danger">Posisi  wajib diisi</p>';
            }elseif ($_GET["required"]=="hire") {
               echo '<p class="error-msg text-danger">Waktu sewa wajib diisi</p>';
            } 
            }?>    
          <input type="hidden"  name="id"  value="<?php echo $id; ?>">                    
          <div class="form-group">
          <input class="form-control" placeholder="Nama Depan" name="fname"  value="<?php echo $fname; ?>">
          </div>
          <div class="form-group">
          <input class="form-control" placeholder="Nama Belakang" name="lname" value="<?php echo $lname; ?>">
          </div> 
          <div class="form-group">
          <input type="number" maxlength="11" class="form-control" placeholder="Nomor Kontak" name="number" value="<?php echo $number; ?>">
          </div> 
          <div class="form-group">
          <input class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
          </div> 
          <div class="form-group">
          <input  class="form-control" placeholder="Alamat" name="address" value="<?php echo $address; ?>">
          </div> 
          <div class="form-group">
          <select class="form-control" name="gender">
          <option selected><?php echo $gender; ?></option>
          <option>Laki-Laki</option>
          <option>Perempuan</option>
          <option>Lainnya</option>
          </select>
          </div> 
          <div class="form-group">
          <input type="number" maxlength="2" class="form-control" placeholder="Age" name="age" value="<?php echo $age; ?>">
          </div> 
          <div class="form-group">
          <input class="form-control" placeholder="Position" name="position" value="<?php echo $position; ?>">
          </div> 
          <div class="form-group">
          <input type="date" class="form-control" placeholder="Hire date" name="hire" value="<?php echo $hire; ?>">
          </div> 
          <button type="submit" name="submit" class="btn btn-info">Simpan Perubahan</button>
          <button type="reset" class="btn btn-danger">Kosongkan</button>


                      </form>  
                       </div>
                </div>
              </div>
       <?php include 'theme/footer.php'; }?>