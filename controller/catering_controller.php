<?php
include('../includes/connection.php');


session_start();
if ($_GET['action'] == 'save') {
  $random = rand(10, 100);
  $tgl = date("dmYhis");
  $no_transac = "CAT" . $tgl . $random;
  $date = date("Y/m/d");
  $user_id = $_SESSION['cid'];
  // $kode_produk = $_POST['product_code'];
  // $jml = $_POST['qty'];
  // $jml_total = 120000;
  // $total_barang = $_POST['total_barang'];



  // jika berhasil eksekusi
  // $data = array([
  //   'kode_produk' => $_POST['product_code'],
  //   'jml' => $_POST['qty']
  // ]);

  // untuk memasukan ke table tbltransac
  $hitung_total = mysqli_query($db, 'SELECT SUM(a.harga) as total FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart
  JOIN tblproducts c
  ON
  a.kd_menu = c.product_id JOIN tblsaus d ON
  a.kd_saus = d.id_saus WHERE b.c_id = "' . $user_id . '"');
  $ht = mysqli_fetch_array($hitung_total);
  $jml_total = $ht['total'];
  $instransac = "INSERT INTO tbltransac (transac_code, date, transac_type, status, total_price, customer_id)
      VALUES ('$no_transac','$date','Catering','pending','$jml_total','$user_id')";
  mysqli_query($db, $instransac) or die('Error, gagal menyimpan data catering');

  // untuk memasukan ke table tbltransacdetail
  $query_select = mysqli_query($db, 'SELECT * FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart
  JOIN tblproducts c
  ON
  a.kd_menu = c.product_id JOIN tblsaus d ON
  a.kd_saus = d.id_saus WHERE b.c_id = "' . $user_id . '"');
  while ($row = mysqli_fetch_array($query_select)) {
    $query2 = "INSERT INTO tbltransacdetail (product_code, kd_saus, qty, transac_code, harga)
    VALUES ('" . $row['kd_menu'] . "', '" . $row['kd_saus'] . "', '" . $row['qty'] . "', '$no_transac' ,
    '" . $row['harga'] . "')";
    mysqli_query($db, $query2) or die('Error, gagal menyimpan data catering');
  }
  echo ("<script language='JavaScript'>
         window.location.href='../catering.php?nt=$no_transac';
         window.alert('Data Catering berhasil disimpan')
       </script>");
}



?>
<script src="../assets/js/cart.js"></script>