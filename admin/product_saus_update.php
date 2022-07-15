<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';

  $query = 'SELECT * FROM `tblsaus` WHERE `id_saus` = "' . $_GET['id'] . '" ';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id_saus'];
    $name = $row['nama_saus'];
    $price = $row['harga_saus'];
    $status = $row['stok_saus'];
  }
  $id = $_GET['id'];
  $query1 = "SELECT * FROM tblcategory";
  $result1 = mysqli_query($db, $query1);
?>
<style type="text/css">
  .error-msg {
    text-align: center;
    font-weight: bold;
  }
</style>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Perbaharui Menu</div>
    <div class="card-body">
      <form role="form" method="post" action="productcontroller_saus.php?action=update" enctype="multipart/form-data">
        <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"] == "product") {
              echo '<p class="error-msg text-danger">Nama Produk Harus Diisi</p>';
            } elseif ($_GET["required"] == "category") {
              echo '<p class="error-msg text-danger">Kategori Harus Diisi</p>';
            } elseif ($_GET["required"] == "type") {
              echo '<p class="error-msg text-danger">Jenis Harus Diisi</p>';
            } elseif ($_GET["required"] == "price") {
              echo '<p class="error-msg text-danger">Harga Harus Diisi</p>';
            } elseif ($_GET["required"] == "producttaken") {
              echo '<p class="error-msg text-danger">Nama produk sudah ada.</p>';
            }
          }      ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
          <span>Nama Menu</span>
          <input class="form-control" placeholder="Nama Produk" name="product" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
          <span>Status</span>
          <select class="form-control" name="status">
            <option selected hidden value="<?php echo $status; ?>"><?php echo $status; ?></option>
            <option value="Tersedia">Tersedia</option>
            <option value="Habis">Habis</option>
          </select>
        </div>

        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" class="form-control" placeholder="Harga" name="price" value="<?php echo $price; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-info">Perbaharui</button>
      </form>
    </div>
  </div>
</div>
<!-- <script src="vendor/jquery/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(e){
    $('input').change(function(){
      var toplam=0;
      $('input[id=price]').each(function(){
        toplam = toplam + parseInt($(this).val());
      })
      $('input[id=sale]').val(toplam);
    });

  });
</script> -->
<!--footer area-->
<?php include 'theme/footer.php';
} ?>