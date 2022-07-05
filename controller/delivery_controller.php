<?php
include('../includes/connection.php');


session_start();
if ($_GET['action'] == 'save') {
  $random = rand(10, 100);
  $tgl = date("dmYhis");
  $no_transac = "DEL" . $tgl . $random;
  $date = date("Y/m/d");
  $user_id = $_SESSION['cid'];
  $type = "Delivery";
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
  $hitung_total = mysqli_query($db, 'SELECT SUM(a.harga) as total FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart
  JOIN tblproducts c
  ON
  a.kd_menu = c.product_id JOIN tblsaus d ON
  a.kd_saus = d.id_saus WHERE b.c_id = "' . $user_id . '" AND b.kd_cart = "' . $kd_cart . '"');

  $ht = mysqli_fetch_array($hitung_total);
  $jml_total = $ht['total'];

  $queryCek = mysqli_query($db, 'SELECT * FROM tbltransac WHERE customer_id = "' . $user_id . '" AND transac_type = "' . $type . '" AND transac_code = "' . $no_transac . '" ');
  $cek = mysqli_num_rows($queryCek);
  if ($cek > 0) {
    $uptransac = "UPDATE tbltransac SET transac_code = '$no_transac', total_price = '$jml_total' WHERE customer_id = '". $user_id . "'";
    mysqli_query($db, $uptransac) or die('Error, gagal menyimpan data delivery');
  } else {
    $instransac = "INSERT INTO tbltransac (transac_code, date, transac_type, status, total_price, customer_id)
    VALUES ('$no_transac','$date','Delivery','pending','$jml_total','$user_id')";
    mysqli_query($db, $instransac) or die('Error, gagal menyimpan data delivery');
  }

  // untuk memasukan ke table tbltransacdetail
  $query_select = mysqli_query($db, 'SELECT * FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart
  JOIN tblproducts c
  ON
  a.kd_menu = c.product_id JOIN tblsaus d ON
  a.kd_saus = d.id_saus WHERE b.kd_cart = "' .$kd_cart. '"');
  while ($row = mysqli_fetch_array($query_select)) {
    $query2 = "INSERT INTO tbltransacdetail (product_code, kd_saus, qty, transac_code, harga)
    VALUES ('" . $row['kd_menu'] . "', '" . $row['kd_saus'] . "', '" . $row['qty'] . "', '$no_transac' ,
    '" . $row['harga'] . "')";
    mysqli_query($db, $query2) or die('Error, gagal menyimpan data delivery');
  }

  // query delete cart dan cart detail
  $deletecart = 'DELETE From tblcartdetail WHERE kd_cart = "' .$kd_cart. '"';
  mysqli_query($db, $deletecart) or die(mysqli_error($db));
  $deletecartdetail = 'DELETE From tblcart WHERE kd_cart = "' .$kd_cart. '"';
  mysqli_query($db, $deletecartdetail) or die(mysqli_error($db));

  echo ("<script language='JavaScript'>
    window.location.href = '../delivery_rincian.php?no_transaksi=$no_transac';
    window.alert('Data delivery berhasil disimpan. Mohon Lakukan pembayaran Down Payment')
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

if ($_GET['action'] == 'selesai') {
$transac_code = $_POST['transac_code'];
$status = "done";
//Update table transac
$query2 = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $transac_code . "'";
mysqli_query($db, $query2) or die(mysqli_error($db));
echo ("<script language='JavaScript'>
  window.location.href = '../index.php';
  window.alert('Pemesanan telah selesai')
</script>");
}


//code save bukti transfer dp

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
      $filenew = "BT" . $transac_code . "." . $type;
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
        $status_transfer = "paid";

        $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
            VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', 0, 'customer','','', '" . $transac_code . "')";
        mysqli_query($db, $query) or die(mysqli_error($db));

        // update status
        $query_update = "UPDATE tbltransac SET status = '" . $status_transfer . "' WHERE
        transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // TODO: Gunakan sweet alert
        echo ("<script language='JavaScript'>
        window.location.href='../order_detail_delivery.php?&no_transaksi=$transac_code';
        window.alert('Terima kasih telah melakukan pemesanan! Pesanan anda akan kami proses mohon menunggu dan cek status pesanan di menu pesanan saya.')
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

//code save bukti transfer revisi
//remove file
//update file baru pada taable bukti transfer

if ($_GET['action'] == 'savetrfrvs') {

  if (isset($_POST['confirm'])) {
    if ($_FILES['upload']['name'] != "") {

      $transac_code = $_POST['transac_code'];
      $datetime = date('Y-m-d H:i:s');
      // get file
      $file = $_FILES['upload']['name'];
      $tmp = $_FILES['upload']['tmp_name'];
      $type = pathinfo($file, PATHINFO_EXTENSION);
      $file_name = $_POST["file_name"];

      $user_id = $_SESSION['cid'];


      // Rename nama file
      $filenew = "BT" . $transac_code . "." . $type;
      // Set path folder tempat menyimpan fotonya
      $path = "../assets/bukti_transfer/" . $filenew;
      $path2 = $_SERVER['DOCUMENT_ROOT'] . "/si_andakar/assets/bukti_transfer/" . $file_name;
      // hapus file sebelumnya
      @unlink($path2);
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
        $status_transfer = "dp";

        $query_update = "UPDATE tblbuktitransfer SET status = 'after_revision', nominal_trf = 0 , user = 'customer', margin = 0  WHERE
        no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update status
        $dp = "after_revision";
        $query_update = "UPDATE tbltransac SET status = '" . $dp . "' WHERE
        transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // TODO: Gunakan sweet alert
        echo ("<script language='JavaScript'>
        window.location.href='../order_detail_delivery.php?&no_transaksi=$transac_code';
        window.alert('Terima kasih telah melakukan pembayaran! Tunggu pembayaran anda dikonfirmasi oleh kami.')
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

// untuk upload ulang bukti transfer jika transfer sebelumnya tidak sesuai
if ($_GET['action'] == 'savetrfrvslns') {

  if (isset($_POST['confirm'])) {
    if ($_FILES['upload']['name'] != "") {

      $transac_code = $_POST['transac_code'];
      $datetime = date('Y-m-d H:i:s');
      // get file
      $file = $_FILES['upload']['name'];
      $tmp = $_FILES['upload']['tmp_name'];
      $type = pathinfo($file, PATHINFO_EXTENSION);
      $file_name = $_POST["file_name"];

      $user_id = $_SESSION['cid'];


      // Rename nama file
      $filenew = "BTLNS" . $transac_code . "." . $type;
      // Set path folder tempat menyimpan fotonya
      $path = "../assets/bukti_transfer/" . $filenew;
      $path2 = $_SERVER['DOCUMENT_ROOT'] . "/si_andakar/assets/bukti_transfer/" . $file_name;
      // hapus file sebelumnya
      @unlink($path2);
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
        $status_transfer = "after_revision_lns";

        $query_update = "UPDATE tblbuktitransfer SET status = 'after_revision_lns', nominal_trf = 0 , user = 'customer', margin = 0  WHERE
        no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update status
        $after_revision_lns = "after_revision_lns";
        $query_update = "UPDATE tbltransac SET status = '" . $after_revision_lns . "' WHERE
        transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // TODO: Gunakan sweet alert
        echo ("<script language='JavaScript'>
        window.location.href='../order_detail_delivery.php?&no_transaksi=$transac_code';
        window.alert('Terima kasih telah melakukan pelunasan! Pesanan anda akan kami proses dan dikirimkan mohon menunggu dan cek status pesanan di menu pesanan saya.')
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

if ($_GET['action'] == 'savetrflunas') {

  if (isset($_POST['submit_pelunasan'])) {
    if ($_FILES['upload_pelunasan']['name'] != "") {

      $transac_code = $_POST['transac_code'];
      $datetime = date('Y-m-d H:i:s');
      // get file
      $file = $_FILES['upload_pelunasan']['name'];
      $tmp = $_FILES['upload_pelunasan']['tmp_name'];
      $type = pathinfo($file, PATHINFO_EXTENSION);

      $user_id = $_SESSION['cid'];


      // Rename nama file
      $filenew = "BTLNS" . $transac_code . "." . $type;
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

        $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`,`user`, `no_transac`)
            VALUES ('" . $datetime . "','" . $nama . "','lunas','customer','" . $transac_code . "')";
        mysqli_query($db, $query) or die(mysqli_error($db));

        // update status
        $pelunasan = "pelunasan";
        $query_update = "UPDATE tbltransac SET status = '" . $pelunasan . "' WHERE
        transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // TODO: Gunakan sweet alert
        echo ("<script language='JavaScript'>
        window.location.href='../order_detail_delivery.php?&no_transaksi=$transac_code';
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



?>
<script src="../assets/js/cart.js"></script>