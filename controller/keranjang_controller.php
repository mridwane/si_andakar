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
$kd_menu = $_POST['kd_menu'];
$kd_saus = $_POST['kd_saus'];
$id = $_POST['id'];
$fungsi = $_POST['fungsi'];
$qty = $_POST['qty'];
$jenis_cart = $_POST['jenis_cart'];
$harga = $_POST['harga'];
$cid = $_SESSION["cid"];
$date = date("Y-m-d");
$kd_cart = $jenis_cart.$cid;
// $kd_cart = "Delivery4";

if ($fungsi == 'Delete'){
     $query = 'DELETE From tblcartdetail WHERE id = "'.$id.'"';
     $result = mysqli_query($db, $query) or die(mysqli_error($db));

    //  if($result > 1) {
    //     echo 'Gagal dihapus';
    //  }
    //  else {
    //     echo 'Berhasild dihapus';
} elseif ($fungsi == 'DeleteAll'){
$query = 'DELETE From tblcartdetail WHERE kd_cart = "'.$kd_cart.'"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// if($result > 1) {
// echo 'Gagal dihapus';
// }
// else {
// echo 'Berhasild dihapus';
} else {
    // echo $kd_saus.$qty;
    $query1 = 'SELECT * From tblcart WHERE c_id = "'.$cid.'"';
    $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result1);
    if(!$row) {
        $query1 = "INSERT INTO tblcart (kd_cart, jenis_cart, date, c_id) VALUES ('".$kd_cart."', '".$jenis_cart."',
        '".$date."', '".$cid."')";
        $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));

        $query2 = "INSERT INTO tblcartdetail (kd_cart, kd_menu, kd_saus, qty, harga) VALUES ('".$kd_cart."', '".$kd_menu."',
        '".$kd_saus."', '".$qty."', '".$harga."')";
        $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));

        // echo "<script>
        //     alert('Berhasil menambahkan ke pesanan');
        // </script>";
        // if($result1){
            // echo "<script>
            //     alert('Berhasil menambahkan ke pesanan');
            // </script>";
        // }
        // else {
        //     echo "<script>
        //         alert('Gagal menambahkan ke pesanan');
        //     </script>";
        // }

        
    }
    else {

        // $query = 'SELECT * From tblcartdetail WHERE c_id = "'.$cid.'" AND ';
        // $result = mysqli_query($db, $query) or die(mysqli_error($db));
        // $row = mysqli_fetch_assoc($result);

        // if(!$row) {
            $query2 = "INSERT INTO tblcartdetail (kd_cart, kd_menu, kd_saus, qty, harga) VALUES ('".$kd_cart."',
            '".$kd_menu."',
            '".$kd_saus."', '".$qty."', '".$harga."')";
            $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
        // }
        
        
        // if($result2){
        //     echo "<script>
        //         alert('Berhasil menambahkan ke pesanan');
        //     </script>";
        // }
        // else {
        //     echo "<script>
        //         alert('Gagal menambahkan ke pesanan');
        //     </script>";
        // }
    }
}








?>