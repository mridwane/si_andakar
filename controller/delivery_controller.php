<?php
include('../includes/connection.php');


session_start();
if ($_GET['action'] == 'save') {
  $random = rand(10, 100);
  $tgl = date("dmYhis");
  $no_transac = "DEL" . $tgl . $random;
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
      VALUES ('$no_transac','$date','delivery','4','$jml_total','$user_id')";
  mysqli_query($db, $instransac) or die('Error, gagal menyimpan data delivery');

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
    mysqli_query($db, $query2) or die('Error, gagal menyimpan data delivery');
  }
  echo ("<script language='JavaScript'>
         window.location.href='../delivery.php?nt=$no_transac';
         window.alert('Data Delivery berhasil disimpan')
       </script>");
}

if ($_GET['action'] == 'savetrf') {

  if (isset($_POST['confirm'])) {
    if ($_FILES['upload']['name'] != "") {

      $transac_code = $_POST['transac_code'];
      $datetime = date('Y-m-d H:i:s');
      // get file
      $file = $_FILES['upload']['name'];
      $tmp = $_FILES['upload']['tmp_name'];
      $type = pathinfo($file, PATHINFO_EXTENSION);

      $user_id = $_SESSION['cid'];


      // Rename nama file
      $filenew = "BT" . $transac_code;
      // Set path folder tempat menyimpan fotonya
      $path = "../assets/bukti_transfer/" . $filenew;



      // Cek apakah gambar berhasil diupload atau tidak
      $status = false;
      if (move_uploaded_file($tmp, $path)) {
        copy($path, $path);
      }
      if ($status == false) {

        // Proses simpan ke Database

        $nama = "";

        if ($type != "") {
          $nama = $filenew;
        }

        $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `no_transac`)
            VALUES ('" . $datetime . "','" . $nama . "','" . $transac_code . "')";
        mysqli_query($db, $query) or die(mysqli_error($db));

        // update status
        $paid = "paid";
        $query_update = "UPDATE tbltransac SET status = '" . $paid . "' WHERE
        transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // TODO: Gunakan sweet alert
        echo ("<script language='JavaScript'>
        window.location.href='../index.php';
        window.alert('Terima kasih telah melakukan pemesanan! Pesanan anda akan kami proses dan dikirimkan mohon menunggu dan cek status pesanan di menu pesanan saya.')
        </script>");
      } else {
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, butkti transfer gagal untuk diupload.";
      }
    } else {
?>
      <script type="text/javascript">
        alert("Silahkan pilih foto bukti transfer terlebih dahulu untuk di upload");
      </script>
<?php
    }
  }
}

// elseif ($_GET['action'] == 'update') {
//   $transac_code = $_POST['transac_code'];
//   $person_count = $_POST['person_count'];
//   $date = $_POST['date'];
//   $time = $_POST['time'];
//   $date_time = date('Y-m-d H:i:s', strtotime("$date $time"));

//   //Update table transac
//   $query2 = "UPDATE tbltransac SET reservation_date_time = '" . $date_time . "', person_count = '" . $person_count . "' WHERE transac_code='" . $transac_code . "'";
//   mysqli_query($db, $query2) or die(mysqli_error($db));
//   echo ("<script language='JavaScript'>
//          window.location.href='../index.php';
//          window.alert('Data Delivery berhasil disimpan. Mohon Tunggu Konfirmasi dari kami yaa')
//        </script>");
// }

// elseif ($_GET['action'] == 'updatePesanan') {
//   $transac_code = $_POST['transac_code'];
//   $kode_produk = $_POST['product_code'];
//   $jml = $_POST['qty'];
//   $jml_total = $_POST['jml_total'];

//   // jika berhasil eksekusi
//   $data = array([
//   'kode_produk' => $_POST['product_code'],
//   'jml' => $_POST['qty']
//   ]);

//   // query 1 untuk memasukan ke table tblreq
//   $query1 = "UPDATE tbltransac SET total_price = '" . $jml_total . "'
//   WHERE transac_code='" . $transac_code . "'";
//   mysqli_query($db, $query1) or die('Error, gagal menyimpan data reservasi');

//   // query 2 untuk memasukan ke table tblreqdetail
//   foreach ($data as $key => $value) {
//     for ($i = 0; $i < count($value['kode_produk']); $i++) { 
//       $query2="UPDATE tbltransacdetail SET qty = '" . $value['jml'][$i] . "' WHERE
//       product_code='".$value['kode_produk'][$i]."'";
//       mysqli_query($db, $query2) or die('Error, gagal menyimpan data reservasi'); 
//     } 
//   }
//   echo ("<script language='JavaScript'>
//     window.location.href = '../reservasi.php?nt=".$transac_code."';
//     window.alert('Data Pesanan berhasil diupdate.')
//   </script>");
// }

// elseif ($_GET['action'] == 'batal') {
//   $transac_code = $_POST['transac_code'];
//   //Update table transac
//   $query3 = "UPDATE tbltransac SET status = '2'
//   WHERE transac_code='" . $transac_code . "'";
//   mysqli_query($db, $query3) or die(mysqli_error($db));
//   echo ("<script language='JavaScript'>
//     window.location.href = '../order.php';
//     window.alert('Data Reservasi telah anda batalkan')
//   </script>");
// }

// elseif ($_GET['action'] == 'hapus') {
//   $transac_code = $_POST['transac_code'];
//   //Update table transac
//   $query1 = "DELETE FROM tbltransac WHERE transac_code='" . $transac_code . "'";
//   mysqli_query($db, $query1) or die(mysqli_error($db));
//   $query2 = "DELETE FROM tbltransacdetail WHERE transac_code='" . $transac_code . "'";
//   mysqli_query($db, $query2) or die(mysqli_error($db));

//   echo ("<script language='JavaScript'>
//     window.location.href = '../index.php';
//     window.alert('Pesanan anda telah dihapus.')
//   </script>");
// }

?>
<script src="../assets/js/cart.js"></script>