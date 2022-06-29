<?php

// controller ini digunakan untuk nampilin angka di keranjang

include('../includes/connection.php');
session_start();
if(!isset($_SESSION["cid"])){
header("Location: login.php");
}else{
include('../includes/connection.php');
// if (isset($_SESSION['C_ID']))
}
// var_dump($kd_menu);
$cid = $_SESSION['cid'];
$jenis = $_POST['jenis'];
$kd_cart = $jenis.$cid;
// $jenis = "Delivery";


if($jenis == "Delivery"){
    // $data = [];
    $query = mysqli_query($db, 'SELECT * FROM tblcartdetail a INNER JOIN tblcart b ON a.kd_cart = b.kd_cart WHERE b.c_id = "'.$cid.'" AND a.kd_cart = "'.$kd_cart.'"');
    $jumlah = mysqli_num_rows($query);
    echo json_encode($jumlah);
    // var_dump($jumlah);
}
elseif($jenis == "Catering"){
    // $data = [];
    $query = mysqli_query($db, 'SELECT * FROM tblcartdetail a INNER JOIN tblcart b ON a.kd_cart = b.kd_cart WHERE b.c_id = "'.$cid.'" AND a.kd_cart = "'.$kd_cart.'"');
    $jumlah = mysqli_num_rows($query);
    echo json_encode($jumlah);
    // var_dump($jumlah);
}



?>