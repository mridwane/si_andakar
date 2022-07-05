<?php
// include('../includes/connection.php');
session_start();
if(!isset($_SESSION["userid"])){
header("Location: login.php");
}else{
include('../../includes/connection.php');
// if (isset($_SESSION['C_ID']))
}
// var_dump($kd_menu);
$kd_menu = $_POST['kd_menu'];
$kd_saus = $_POST['kd_saus'];
$id = $_POST['id'];
$fungsi = $_POST['fungsi'];
$qty = $_POST['qty'];
$jenis_cart = $_POST['jenis_cart'];
$harga = $_POST['harga'];
$userid = $_SESSION["userid"];
$date = date("Y-m-d");
$kd_cart = $jenis_cart.$userid;

// $kd_menu = "49";
// $kd_saus = "S002";
// // $id = $_POST['id'];
// $fungsi = "addMenu";
// $qty = 3;
// $jenis_cart = "Catering";
// $harga = 29000;
// $userid = $_SESSION["userid"];
// $date = date("Y-m-d");
// $kd_cart = $jenis_cart.$userid;
// $kd_cart = "Delivery4";

if ($fungsi == 'Delete'){
    $query = 'DELETE From tblcartdetail WHERE id = "'.$id.'"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

} elseif ($fungsi == 'DeleteAll'){
    $query = 'DELETE From tblcartdetail WHERE kd_cart = "'.$kd_cart.'"';
    mysqli_query($db, $query) or die(mysqli_error($db));
    $query2 = 'DELETE From tblcart WHERE kd_cart = "'.$kd_cart.'"';
    mysqli_query($db, $query2) or die(mysqli_error($db));

} elseif($fungsi == 'addMenu') {
    // echo $kd_saus.$qty;
    $query1 = 'SELECT * From tblcart WHERE kd_cart = "'.$kd_cart.'"';
    $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result1);
    if(!$row) {
        $query1 = "INSERT INTO tblcart (kd_cart, jenis_cart, total, date, c_id) VALUES ('".$kd_cart."',
        '".$jenis_cart."', '".$harga."', '".$date."', '".$userid."')";
        $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));

        $query2 = "INSERT INTO tblcartdetail (kd_cart, kd_menu, kd_saus, qty, harga) VALUES ('".$kd_cart."', '".$kd_menu."',
        '".$kd_saus."', '".$qty."', '".$harga."')";
        $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));        
    }
    else {
        $cekCart = mysqli_query($db, "SELECT * FROM tblcartdetail WHERE kd_cart = '".$kd_cart."' AND kd_menu = '".$kd_menu."' AND kd_saus = '".$kd_saus."'");
        $cek = mysqli_num_rows($cekCart);        

        if($cek > 0){
            $query2 = "UPDATE tblcartdetail SET qty = qty + ".$qty.", harga = harga + ".$harga." WHERE kd_cart = '".$kd_cart."' AND kd_menu = '".$kd_menu."' AND kd_saus = '".$kd_saus."'";
            $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
            
           $query = mysqli_query($db, "SELECT SUM(harga) as total FROM tblcartdetail WHERE kd_cart = '".$kd_cart."' AND
           kd_menu = '".$kd_menu."' AND kd_saus = '".$kd_saus."'");
           $row = mysqli_fetch_array($query);
           $total = $row['total'];

           $query2 = "UPDATE tblcart SET total = ".$total." WHERE kd_cart = '".$kd_cart."'";
           $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
        }
        else {
            $query2 = "INSERT INTO tblcartdetail (kd_cart, kd_menu, kd_saus, qty, harga) VALUES ('".$kd_cart."',
            '".$kd_menu."',
            '".$kd_saus."', '".$qty."', '".$harga."')";
            $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));

            $query = mysqli_query($db, "SELECT SUM(harga) as total FROM tblcartdetail WHERE kd_cart = '".$kd_cart."'");
            $row = mysqli_fetch_array($query);
            $total = $row['total'];

            $query2 = "UPDATE tblcart SET total = ".$total." WHERE kd_cart = '".$kd_cart."'";
            $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
        }
    }
} 
?>