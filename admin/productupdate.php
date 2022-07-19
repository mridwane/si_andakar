<?php
session_start();
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
} else {
  include('../includes/connection.php');
  include 'theme/header.php';
  include 'theme/sidebar.php';

  $query = 'SELECT *,category FROM `tblproducts`a inner join `tblcategory` b on a.`category_id` = b.`category_id` WHERE `product_id` = ' . $_GET['id'] . ' ';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['product_id'];
    $name = $row['product_name'];
    $price = $row['price'];
    $type = $row['type'];
    $status = $row['status'];
    $category = $row['category'];
    $image = $row['image'];
    $c_id = $row['category_id'];
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
        <form role="form" method="post" action="productcontroller.php?action=update" enctype="multipart/form-data">
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
          <input type="hidden" name="image_before" value="<?php echo $image; ?>" />
          <div class="form-group">
            <span>Nama Menu</span>
            <input class="form-control" placeholder="Nama Produk" name="product" value="<?php echo $name; ?>">
          </div>
          <div class="form-group">
            <span>Kategori</span>
            <select class="form-control" name="category">
              <option selected hidden value="<?php echo $c_id; ?>"><?php echo $category; ?></option>
              <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group">
            <span>Jenis</span>
            <select class="form-control" name="type">
              <option selected hidden value="<?php echo $type; ?>"><?php echo $type; ?></option>
              <option value="Starter">Makanan Pembuka</option>
              <option value="Makanan-Utama">Makanan Utama</option>
              <option value="Makanan-Pendamping">Makanan Pendamping</option>
              <option value="Makanan-Penutup">Makanan Penutup</option>
              <option value="Minuman">Minuman</option>
            </select>
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
          <div class="form-group">
            <div class="img-box">
              <img src="images/<?= $image ?>" width="200" height="200" alt="">

              <div class="form-group">
                <label>Ubah Gambar</label>
                <input type="file" class="form-control" id="upload_image" name="upload_image" accept=".jpeg, .jpg, .png">
              </div>
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
<?php include 'theme/footer.php';
} ?>