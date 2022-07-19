<?php

// controller ini digunakan untuk ngatur fungsi deliveri ketika pesanan sudah selesai dan lewat dua hari

include('../includes/connection.php');
session_start();
if(!isset($_SESSION["userid"])){
header("Location: login.php");
}else{
include('../../includes/connection.php');
// if (isset($_SESSION['C_ID']))
}

$date = date('Y/m/d');
// var_dump($kd_menu);
// $userid = $_SESSION['userid'];
// $jenis = $_POST['jenis'];
// $kd_cart = $jenis.$userid;
// $jenis = "Delivery";


//  $query = mysqli_query($db, 'SELECT * FROM tbltransac WHERE status = "sending" AND transac_type = "Delivery" AND date > "'.$date.'"');
//  $jumlah = mysqli_num_rows($query);
//  echo json_encode($jumlah);

    $uptransac = "UPDATE tbltransac SET status = 'done' WHERE status = 'sending' AND transac_type = 'Delivery' AND date < '".$date."'";
    mysqli_query($db, $uptransac) or die('Error, gagal update delivery');


?>

