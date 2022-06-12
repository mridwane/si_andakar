<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';

$query = 'SELECT *,category,supplier_name FROM `tblproducts`a inner join `tblcategory` b inner join `tblsupplier` c on a.`category_id` = b.`category_id` and a.`supplier_id` = c.`supplier_id`
              WHERE `product_code` = '.$_GET['id'].' ';
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
               $id = $row['product_code'];
               $name = $row['product_name'];
               $quantity = $row['quantity'];
               $category = $row['category'];
               $c_id = $row['category_id'];
               $supplier = $row['supplier_name'];
               $s_id = $row['supplier_id'];
              }              
              $id = $_GET['id'];
$query1 = "SELECT * FROM tblcategory";
$result1 = mysqli_query($db,$query1);
$query2 = "SELECT * FROM tblsupplier";
$result2 = mysqli_query($db,$query2);              
?>
<style type="text/css">
  .error-msg {
    text-align: center;
    font-weight: bold;
  }
</style>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Perbaharui Produk</div>
    <div class="card-body">
      <form role="form" method="post" action="productcontroller.php?action=update">
        <?php
          if (isset($_GET['required'])) {
            if ($_GET["required"]=="product") {
              echo '<p class="error-msg text-danger">Nama produk harus diisi</p>';
            }elseif ($_GET["required"]=="category") {
               echo '<p class="error-msg text-danger">Kategori diperlukan</p>';
            }elseif ($_GET["required"]=="supplier") {
               echo '<p class="error-msg text-danger">Pemasok diperlukan</p>';
            }elseif ($_GET["required"]=="quantity") {
              echo '<p class="error-msg text-danger">qty Harus di isi</p>';
            }  
            }      ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
          <span>Nama Produk</span>
          <input class="form-control" placeholder="Nama Produk" name="product" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" class="form-control" placeholder="Jumlah" name="quantity"
            value="<?php echo $quantity; ?>">
        </div>
        <div class="form-group">
          <span>Kategori</span>
          <select class="form-control" name="category">
            <option selected hidden value="<?php echo $c_id; ?>"><?php echo $category; ?></option>
            <?php while($row1 = mysqli_fetch_array($result1)):; ?>
            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div style="display:none">
          <div class="form-group">
            <span>Pemasok</span>
            <select class="form-control" name="supplier">
              <option selected hidden value="<?php echo $s_id; ?>"><?php echo $supplier; ?></option>
              <?php while($row2 = mysqli_fetch_array($result2)):; ?>
              <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
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
<?php include 'theme/footer.php'; }?>