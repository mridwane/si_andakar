<?php 
if (isset($_POST["add_to_cart"])) 
{
  $av = $_POST['av'];
$qq = $_POST["quant"];
if ($av > 0) {

  if ($av > $qq || $av == $qq)  {

  if (isset($_SESSION["cart"])) 
{
  $itemarrayid = array_column($_SESSION["cart"], "ids");
  if (!in_array($_GET["id"], $itemarrayid)) {
   
    $count=count($_SESSION["cart"]);
    $itemarray = array(
     'ids' => $_GET["id"],
     'name' => $_POST["hiddenname"],
     'price' => $_POST["hiddenprice"],
     'quantity' => $_POST["quant"]);
     $_SESSION["cart"][$count] = $itemarray;
    echo "<script>alert('Produk di tambahkan ke keranjang')</script>";
    echo "<script>window.location = 'cart.php'</script>";
  }else{
    echo "<script>alert('Barang sudah ditambahkan')</script>";
    echo "<script>window.location = 'cart.php'</script>";
  }
}
else
{
  $itemarray = array(
  'ids' => $_GET["id"], 
  'name' => $_POST["hiddenname"],
  'quantity' => $_POST["quant"]);
  $_SESSION['cart'][0] = $itemarray;
}
}else{
        echo '<script>alert("Invalid Quantity")</script>';
      echo '<script>window.location="index.php"</script>';

}
}else{
  echo '<script>alert("Barang melebihi stok")</script>';
      echo '<script>window.location="index.php"</script>';
}
}


 ?>
<div class="col-10">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <section id="beranda" class="beranda">
               <div class="container-fluid">
                  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner style-jumbotron" style="box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);">
                        <div class="carousel-item active">
                           <img src="images/jb1.jpg" class="d-block w-100" alt="...">
                           <div class="carousel-caption d-none d-md-block">
                              <h5>First slide label</h5>
                              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <img src="images/jb1.jpg" class="d-block w-100" alt="...">
                           <div class="carousel-caption d-none d-md-block">
                              <h5>Second slide label</h5>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <img src="images/jb1.jpg" class="d-block w-100" alt="...">
                           <div class="carousel-caption d-none d-md-block">
                              <h5>Third slide label</h5>
                              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>

               <div class="container-fluid">
                  <div class="judul">
                     <h3><b>Tentang Kami</b></h3>
                  </div>
                  <div class="row">
                     <div class="col-7 warna">
                        <div class="text-keunggulan green">
                           <p>
                              PT Purna Baja Harsco pada awalnya bernama PT Purna Baja Heckett, didirikan pada
                              tanggal 2 November 1983, sebagai perusahaan hasil kerja sama antara Dana Pensiun Krakatau
                              Steel
                              dan Harsco Corporation (Amerika Serikat), dimana dana pensiun Krakatau Steel sebagai
                              pemegang
                              saham mayoritas dalam keraj sama tersebut. Kemudian Pada tanggal 15 Maret 2012 perusahaan
                              mengubah name
                              menjadi PT. Purna Baja Harsco. Harsco Corporation melalui Harsco Metals menyediakan jasa
                              kepada
                              industri
                              metalurgi global di lebih dari 160 lokasi pada lebih dari 30 negara.
                           </p>
                        </div>
                     </div>
                     <div class="col-5">
                        <img src="images/logo/Logo_PBH.png" alt="" width="100%">
                     </div>
                  </div>
               </div>
            </section>
            <section id="produk" class="produk">
               <div class="container-fluid">
                  <div class="judul">
                     <h3><b>Produk</b></h3>
                  </div>
                  <!-- <div class="row bungkus-produk">
                     <div class="col-4">
                        <p>
                           <center>Pencarian</center>
                        </p>
                        <div class="pencarian">
                           <input type="text" placeholder="cari">
                           <a href="#">
                              <span class="material-icons">search</span>
                           </a>
                        </div>
                        <br>
                     </div>
                     <div class="col-8">
                        <p>
                           <center>Kategori</center>
                        </p>
                        <div class="kategori">
                           <a href="index.php?category=all"> Semua Tanaman </a>
                           <a href="index.php?category=gantung"> Tanaman Gantung </a>
                           <a href="index.php?category=standar"> Tanaman Standar </a>
                           <a href="index.php?category=koleksi"> Tanaman Koleksi </a>
                        </div>
                     </div>
                  </div> -->
                  <?php 
                           $category = "Semua Tanaman";
                           if(isset($_GET['category'])){
                              if($_GET['category']=="all"){
                                 $category = "Semua Tanaman";
                              }elseif($_GET['category']=="gantung"){
                                 $category = "Tanaman Gantung";
                              }elseif($_GET['category']=="standar"){
                                 $category = "Tanaman Standar";
                              }elseif($_GET['category']=="koleksi"){
                                 $category = "Tanaman Koleksi";
                              }
                           }   
                           // echo "Menampilkan tanaman dengan kategori: ".$category; 
                        ?>
                  <div class="row">
                     <?php 
                  $query = "SELECT * FROM tblproducts WHERE quantity != 0 GROUP BY product_code";
                  if(isset($_GET['category'])){
                     if($_GET['category']=="all"){
                        $query = "SELECT * FROM tblproducts WHERE quantity != 0 GROUP BY product_code";
                     }elseif($_GET['category']=="gantung"){
                        $query = "SELECT * FROM tblproducts WHERE quantity != 0 AND `category_id`=1 GROUP BY product_code";
                     }elseif($_GET['category']=="standar"){
                        $query = "SELECT * FROM tblproducts WHERE quantity != 0 AND `category_id`=2 GROUP BY product_code";
                     }elseif($_GET['category']=="koleksi"){
                        $query = "SELECT * FROM tblproducts WHERE quantity != 0 AND `category_id`=3 GROUP BY product_code";
                     }else{
                        $query = "SELECT * FROM tblproducts WHERE quantity != 0 GROUP BY product_code";
                     }
                  }
                  $result = mysqli_query($db,$query);
                  if (mysqli_num_rows($result)>0) 
                  {
                  while ($row=mysqli_fetch_array($result)) 
                  {
                     $_SESSION['zero'] = $row["quantity"];
                     $_SESSION['one'] = $row["product_code"];
                  if ($_SESSION['zero']==1) {
                  $sqls = "UPDATE tblproducts SET status = 'Unavailable' WHERE product_code='".$_SESSION['one']."'";
                     mysqli_query($db,$sqls)or die(mysqli_error($db));
                  }
                  ?>
                     <div class="col-lg-3">
                        <div class="kartu-produk">
                           <form method="post" action="index.php?action=add&id=<?php echo $row["product_code"]; ?>">
                              <img src="admin/images/<?php echo $row["image"]; ?>">
                              <div class="spesifikasi">
                                 <h1><?php echo $row["product_name"]; ?> </h1>
                                 <h2>Tersedia ( <b><?php echo $row["quantity"]; ?></b> )</h2>
                                 <div class="row aksi">
                                    <input class="jumlah" type="number" name="quant" value="1">
                                    <input class="form-control" type="hidden" name="av"
                                       value="<?php echo $row["quantity"]; ?>">
                                    <input class="form-control" type="hidden" name="hiddenname"
                                       value="<?php echo $row["product_name"]; ?>">
                                    <input class="form-control" type="hidden" name="hiddenprice"
                                       value="<?php echo $row["price"]; ?>">
                                    <button name="add_to_cart">
                                       Pesan
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <?php
                  }
                  }
                  ?>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
</div>