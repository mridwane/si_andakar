<?php $page = "cart"; ?>

<?php include('includes/connection.php');?>

<!--header area-->
<?php include 'includes/header.php'; ?>

<!--sidebar area-->
<?php include 'includes/sidebar.php'; ?>
<?php 
//  fungsi untuk menghapus cart berdasarkan ID
if (isset($_GET["action"])) {
  if ($_GET["action"]=='delete') {
    foreach ($_SESSION["cart"] as $keys => $values) {
      if ($values['ids']==$_GET["id"]) {
        unset($_SESSION["cart"][$keys]);
        echo '<script>alert("Product dihapus")</script>';
        echo '<script>window.location="cart.php"</script>';
      }
    }
  }
}  

// fungsi untuk merubah, engga tau merubah apa ini yak kkkwkwkw
if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["cart"] as &$value){
    if($value['ids'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after found the product
    }
  }
} 


?>

<div class="col-10">
  <div class="container-fluid">
    <div class="row">
      <div class="col-9">
        <div class="card mb-3">
          <div class="card-header">
            <center>
              <h2>Keranjang</h2>
            </center>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table " width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Jumlah Pesanan</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if (!empty($_SESSION["cart"])) {
                        $_SESSION['mm']=0;
                        $totalqty=0;
                        foreach($_SESSION["cart"] as $keys => $values){
                          $totalqty += (int)$values["quantity"]; 
                    ?>
                    <tr>
                      <td><?php echo $values["name"]; ?></td>
                      <td><?php echo $values["quantity"]; ?></td>
                      <td>
                        <a class="danger" onclick="return confirm('Are you sure?')"
                          href="cart.php?action=delete&id=<?php echo $values["ids"]; ?>">
                          <span class="material-icons">
                            delete
                          </span>
                        </a>
                      </td>
                    </tr>
                    <?php 
                        // sepertinya ini skrip buat total harga ya san?
                        // $name= $values["name"];
                        // $_SESSION['mm'] = $_SESSION['mm'] + ($values["quantity"]) + ($values["quantity"]);
                        }
                      ?>
                    <tr>
                      <td>
                        <a class="tombol-hijau" href="addprod.php">
                          Kirim Pesanan
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3 center-position">
        <img src="images/shopping.svg" alt="" width="250px">
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>