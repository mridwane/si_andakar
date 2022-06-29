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
// $cid = $_SESSION['cid'];
$type = $_POST['type'];
// $type = "Makanan-Utama";
// $kd_cart = $jenis.$cid;


// if($jenis == "Delivery"){
    // $data = [];
$query = mysqli_query($db, 'SELECT b.category FROM tblproducts a JOIN tblcategory b ON a.category_id = b.category_id
WHERE a.type = "'.$type.'" GROUP BY category');
echo'<li class="button-sub active" data-filter="">All</li>';
while($row = mysqli_fetch_array($query)){
// $data[] = $row;
    echo '<li class="button-sub" data-filter=".'.$row["category"].'">'.$row["category"].'</li>';

}
// echo json_encode($data);
// }





?>