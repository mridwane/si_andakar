<?php
include('../includes/connection.php');

session_start();
if ($_GET['action'] == 'save') {
  $random = rand(10, 100);
  $tgl = date("dmYhis");
  $no_transac = "res" . $tgl . $random;
  $date = date("Y/m/d");
  $user_id = $_SESSION['cid'];
  $kode_produk = $_POST['product_code'];
  $jml = $_POST['qty'];
  $jml_total = $_POST['jml_total'];
  // $total_barang = $_POST['total_barang'];

  // jika berhasil eksekusi
  $data = array([
    'kode_produk' => $_POST['product_code'],
    'jml' => $_POST['qty']
  ]);

  // query 1 untuk memasukan ke table tblreq
  $query1 = "INSERT INTO tbltransac (transac_code, date, transac_type, status, total_price, customer_id)
      VALUES ('$no_transac','$date','reservasi','0','$jml_total','$user_id')";
  mysqli_query($db, $query1) or die('Error, gagal menyimpan data reservasu');

  // query 2 untuk memasukan ke table tblreqdetail
  foreach ($data as $key => $value) {
    for ($i = 0; $i < count($value['kode_produk']); $i++) {
      $query2 = "INSERT INTO tbltransacdetail (product_code, qty, transac_code)
          VALUES ('" . $value['kode_produk'][$i] . "', '" . $value['jml'][$i] . "', '$no_transac')";
      mysqli_query($db, $query2) or die('Error, gagal menyimpan data reservasu');
    }
  }
  echo ("<script language='JavaScript'>
         window.location.href='../next_menu.php?nt=$no_transac';
         window.alert('Data Reservasi berhasil disimpan')
       </script>");
}

if ($_GET['action'] == 'update') {
  $transac_code = $_POST['transac_code'];
  $person_count = $_POST['person_count'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $date_time = date('Y-m-d H:i:s', strtotime("$date $time"));

  //Update table transac
  $query2 = "UPDATE tbltransac SET reservation_date_time = '" . $date_time . "', person_count = '" . $person_count . "' WHERE transac_code='" . $transac_code . "'";
  mysqli_query($db, $query2) or die(mysqli_error($db));
  echo ("<script language='JavaScript'>
         window.location.href='../index.php';
         window.alert('Data Reservasi berhasil disimpan. Mohon Tunggu Konfirmasi dari kami yaa')
       </script>");
}
?>
<script src="../assets/js/cart.js"></script>