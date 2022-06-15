<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';

$query3 = "SELECT * FROM tblcategory";
$result3 = mysqli_query($db,$query3);

$query2 = 'SELECT current_date FROM tblusers';
$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
while($row2 = mysqli_fetch_array($result2)){   
$date = $row2['current_date'];
}
$sql = 'SELECT `start` + `end` as autonum FROM tblautonumber where `desc` = "PROD"';
$res = mysqli_query($db, $sql) or die(mysqli_error($db));
while($r = mysqli_fetch_array($res)){   
$autonum = $r['autonum'];
}
?>
<style type="text/css">
  .error-msg {
    text-align: center;
    font-weight: bold;
  }
</style>
<!-- Page Heading -->
<div class="container">
  <div class="card card-register mx-auto mt-3">
    <div class="card-header">
      <center>
        <h3>Tambah Menu</h3>
      </center>
    </div>
    <div class="card-body">
      <form role="form" method="post" action="productcontroller.php?action=add" enctype="multipart/form-data">
        <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"]=="product") {
              echo '<p class="error-msg text-danger">Nama Produk Harus Diisi</p>';
            }elseif ($_GET["required"]=="category") {
                echo '<p class="error-msg text-danger">Kategori Harus Diisi</p>';
            }elseif ($_GET["required"]=="type") {
                echo '<p class="error-msg text-danger">Jenis Harus Diisi</p>';
            }elseif ($_GET["required"]=="price") {
                echo '<p class="error-msg text-danger">Harga Harus Diisi</p>';
            }elseif ($_GET["required"]=="producttaken") {
               echo '<p class="error-msg text-danger">Nama produk sudah ada.</p>';
            }
          }
        ?>
        <div class="form-group">
          <label>Kode Menu</label>
          <input class="form-control" readonly value="<?php echo $autonum; ?>" name="code" id="code">
        </div>
        <div class="form-group">
          <label>Nama Menu</label>
          <input class="form-control" placeholder="Menu Name" name="product" autofocus="autofocus">
        </div>
        <div class="form-group" type="hidden">
          <label>Jenis</label>
          <select class="form-control" name="type" id="type">
            <option selected disabled>Pilih Jenis</option>
            <option value="Makanan">Makanan</option>
            <option value="Saus">Saus</option>
            <option value="Minuman">Minuman</option>
          </select>
        </div>
        <div class="form-group" type="hidden">
          <label>Kategori</label>
          <select class="form-control" name="category" id="category">
            <option selected disabled>Pilih Kategori</option>
            <?php while($row3 = mysqli_fetch_array($result3)):; ?>
            <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Harga Menu</label>
          <input type="number" class="form-control" placeholder="Harga Menu" name="price">
        </div>
        <div class="form-group">
          <input class="form-control" type="hidden" name="user" value="<?php echo $_SESSION['userid']; ?>">
        </div>
        <div class="form-group">
          <input class="form-control" readonly type="hidden" placeholder="Date In" name="date"
            value="<?php echo $date ?>">
        </div>
        <div class="form-group">
          <label>Foto Menu</label>
          <input name="foto" type="file" id="foto" class="form-control">
        </div>
        <div class="form-group">
          <label>Detail Produk / Keterangan</label>
          <textarea class="form-control" rows="4" cols="50" maxlength="200" name="detail_product"></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-info">Simpan</button>
        <button type="reset" class="btn btn-danger">Kosongkan</button>



      </form>
    </div>
  </div>
</div>

<!--footer area-->
<?php include 'theme/footer.php'; }?>