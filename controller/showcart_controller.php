<?php
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
// $jenis = "Delivery";


if($jenis == "Delivery"){
    // $data = [];
    $query = mysqli_query($db, 'SELECT * FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart JOIN tblproducts c ON
    a.kd_menu = c.product_id JOIN tblsaus d ON
    a.kd_saus = d.id_saus WHERE b.c_id = "'.$cid.'"');
    while($row = mysqli_fetch_array($query)){
    $data[] = $row;
    }
    echo json_encode($data);  
}



?>