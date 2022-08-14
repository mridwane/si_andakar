<?php
include('../../includes/connection.php');


session_start();
if ($_GET['action'] == 'save') {
  $random = rand(10, 100);
  $tgl = date("dmYhis");
  $no_transac = "DIN" . $tgl . $random;
  $date = date("Y/m/d");
  $user_id = $_SESSION['userid'];
  $type = "Dinein";
  $kd_cart = $type.$user_id;
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
  $hitung_total = mysqli_query($db, 'SELECT SUM(a.harga) as total FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart JOIN tblproducts c ON a.kd_menu = c.product_id JOIN tblsaus d ON a.kd_saus = d.id_saus WHERE b.c_id = "' . $user_id . '" AND b.kd_cart = "' . $kd_cart . '"');
  $ht = mysqli_fetch_array($hitung_total);
  $jml_total = $ht['total'];
  echo $jml_total;

  $queryCek = mysqli_query($db, 'SELECT * FROM tbltransac WHERE customer_id = "' . $user_id . '" AND transac_type = "' . $type . '" AND transac_code = "' . $no_transac . '" ');
  $cek = mysqli_num_rows($queryCek);
  if ($cek > 0) {
    $uptransac = "UPDATE tbltransac SET transac_code = '$no_transac', total_price = '$jml_total' WHERE customer_id = '". $user_id . "'";
    mysqli_query($db, $uptransac) or die('Error, gagal menyimpan data dinein');
  } else {
    $instransac = "INSERT INTO tbltransac (transac_code, date, transac_type, status, total_price, customer_id)
    VALUES ('$no_transac','$date','Dinein','done','$jml_total','$user_id')";
    mysqli_query($db, $instransac) or die('Error, gagal menyimpan data dinein');
  }

  // untuk memasukan ke table tbltransacdetail
  $query_select = mysqli_query($db, 'SELECT * FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart
  JOIN tblproducts c ON a.kd_menu = c.product_id JOIN tblsaus d ON a.kd_saus = d.id_saus WHERE b.kd_cart = "' .$kd_cart. '"');
  while ($row = mysqli_fetch_array($query_select)) {
    $query2 = "INSERT INTO tbltransacdetail (product_code, kd_saus, qty, transac_code, harga)
    VALUES ('" . $row['kd_menu'] . "', '" . $row['kd_saus'] . "', '" . $row['qty'] . "', '$no_transac' ,
    '" . $row['harga'] . "')";
    mysqli_query($db, $query2) or die('Error, gagal menyimpan data dinein');
  }

  // query delete cart dan cart detail
  $deletecart = 'DELETE From tblcartdetail WHERE kd_cart = "' .$kd_cart. '"';
  mysqli_query($db, $deletecart) or die(mysqli_error($db));
  $deletecartdetail = 'DELETE From tblcart WHERE kd_cart = "' .$kd_cart. '"';
  mysqli_query($db, $deletecartdetail) or die(mysqli_error($db));

  echo ("<script language='JavaScript'>
    window.location.href = '../dinein_rincian.php?no_transaksi=$no_transac';
    window.alert('Berhasil')
  </script>");
}


if ($_GET['action'] == 'cancel') {
  $transac_code = $_GET['no_transaksi'];
  $status = "cancel";
  //Update table transac
  $query2 = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $transac_code . "'";
  mysqli_query($db, $query2) or die(mysqli_error($db));
  echo ("<script language='JavaScript'>
           window.location.href='../index.php';
           window.alert('Pemesanan berhasil dibatalkan')
         </script>");
}
?>
<script src="../assets/js/cart.js"></script>