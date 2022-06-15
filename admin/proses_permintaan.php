<?php       
  session_start();
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }else{
    include('../includes/connection.php');
    include 'theme/header.php';
    include 'theme/sidebar.php';
  }
  $random = rand(10,100);
  $tgl = date("dmYhis");
  $no_permintaan = $tgl.$random;
  $date = date("Y/m/d");  
  $user_id = $_SESSION['userid'];
  $kode_produk = $_POST['kode'];
  $jml = $_POST['jml_permintaan'];
  $jml_total = $_POST['jml_total'];
  $total_barang = $_POST['total_barang'];
  if ($total_barang == 0) {
    // jika gagal kirim pesan ke user bahwa permintaan gagal
    echo '<script type="text/javascript">
      alert("Permintaan Gagal, List Barang Kosong!!.");
      window.location = "permintaan_barang.php";
    </script>';
  } 
  else {
     // jika berhasil eksekusi
    $data = array ([
      'kode_produk' => $_POST['kode'],
      'jml' => $_POST['jml_permintaan']
    ]);
     
    // query 1 untuk memasukan ke table tblreq
    $query1 = "INSERT INTO tblreq (no_permintaan, user_id, tgl_input, jml_barang, jml_qty)
    VALUES ('$no_permintaan','$user_id','$date','$total_barang','$jml_total')";
    mysqli_query($db,$query1)or die ('Telah terjadi error pada query 1.');

    // query 2 untuk memasukan ke table tblreqdetail
    foreach ($data as $key => $value) {
      for ($i=0; $i < count($value['kode_produk']); $i++) {
        $query2 = "INSERT INTO tblreqdetail (no_permintaan, product_code, qty)
        VALUES ('$no_permintaan','".$value['kode_produk'][$i]."','".$value['jml'][$i]."')";
        mysqli_query($db,$query2)or die ('Telah terjadi error pada query 2.');
      }
    }
    echo '
      <script type="text/javascript">
      alert("Permintaan Telah Terkirim.");
      window.location = "permintaan_barang.php";
    </script>';
  }
?>

<script src="js/custom-js/permintaan.js"></script>