<?php
// The same dapat ang input name sa Add kag Update.....WHAT THE MEN!!! 
include('../includes/connection.php');
session_start();
if (isset($_POST['submit'])) {

	if ($_GET['action'] == 'add') {
		$code2 = $_POST['code'];
		$product = $_POST['product'];
		$price = $_POST['price'];
		$detail_product = $_POST['detail_product'];
		$result = mysqli_query($db, "SELECT * FROM tblsaus WHERE nama_saus = '" . $product . "'");
		$checkprod = mysqli_num_rows($result);
		if ($checkprod > 0) {
			header("Location: product_saus_add.php?required=producttaken");
		} elseif ($product == "") {
			header("Location: product_saus_add.php?required=product");
		} elseif ($price == "" || $price < 0) {
			header("Location: product_saus_add.php?required=price");
		} else {
			$code = $_POST['code'];
			$date = $_POST['date'];
			$user = $_POST['user'];

			$query = "INSERT INTO `tblsaus`(`nama_saus`, `harga_saus`, `date_saus`, `user_id`, `stok_saus`,`keterangan`)
			VALUES
			('" . $product . "','" . $price . "','" . $date . "','" . $user . "','Tersedia','" . $detail_product . "')";
			mysqli_query($db, $query) or die(mysqli_error($db));
			$sql = "UPDATE `tblautonumber` SET `end`=`end`+`increment` WHERE `desc` = 'PROD'";
			mysqli_query($db, $sql) or die(mysqli_error($db));
				
?>
<script type="text/javascript">
	alert("Berhasil Ditambahkan.");
	window.location = "product_saus.php";
</script>
<?php
			}
		}
	if ($_GET['action'] == 'update') {
		$product = $_POST['product'];
		$status = $_POST['status'];
		$price = $_POST['price'];
		$id = $_POST['id'];

		if ($product == "") {
			header("Location: productupdate.php?required=product&id=" . $id . "");
		} elseif ($price == "") {
			header("Location: productupdate.php?required=price&id=" . $id . "");
		} else {
			$query = 'UPDATE tblsaus set nama_saus ="' . $product . '", harga_saus ="' . $price . '", `stok_saus`="' . $status . '" WHERE id_saus ="' . $id . '"';
			mysqli_query($db, $query) or die(mysqli_error($db));?>

<script type="text/javascript">
	alert("Update Berhasil.");
	window.location = "product_saus.php";
</script>
<?php }
	}
	if ($_GET['action'] == 'updatequantity') {
		$quantity = $_POST['quantity'];
		$id = $_POST['id'];
		if (empty($quantity) || $quantity < 0) {
			header("Location: updatequantity.php?required=quant&id=" . $id . "");
		} else {
			$sql = 'UPDATE tblproducts set quantity = quantity + "' . $quantity . '" WHERE product_code ="' . $id . '"';
			mysqli_query($db, $sql) or die(mysqli_error($db));

			$date = date('Y-m-d H:i:s');
			$uid = $_SESSION['userid'];
			$query = "INSERT INTO `tblstockhistory`(`date`, `qty`, `user_id`, `product_code`)
				VALUES ('" . $date . "','" . $quantity . "','" . $uid . "','" . $id . "')";
			mysqli_query($db, $query) or die(mysqli_error($db));
		?>
<script type="text/javascript">
	alert("Update Berhasil.");
	window.location = "product_saus.php";
</script>
<?php
		}
	}
}
?>