<?php
    // The same dapat ang input name sa Add kag Update.....WHAT THE MEN!!! 
	 include('../includes/connection.php');
	 session_start();
     if (isset($_POST['submit'])) {

		if ($_GET['action'] == 'add') {	
			$code2 = $_POST['code'];
			$product = $_POST['product'];
			$category = $_POST['category'];
			$type = $_POST['type'];
			$price = $_POST['price'];
			$foto= $_FILES['foto']['name'];
			$tmp = $_FILES['foto']['tmp_name'];
			$detail_product = $_POST['detail_product'];
			// Rename nama fotonya dengan menambahkan tanggal dan jam upload
			$fotobaru = $code2.$foto;
			// Set path folder tempat menyimpan fotonya
			$path = "images/".$fotobaru;
				$result = mysqli_query($db, "SELECT * FROM tblproducts WHERE product_name = '".$product."'");
				$checkprod = mysqli_num_rows($result);
				if ($checkprod > 0) {
				header("Location: productadd.php?required=producttaken");    
				}elseif ($product == "") {
				header("Location: productadd.php?required=product");
				}elseif ($category == "") {
					header("Location: productadd.php?required=category");
					}elseif ($type == "") {
					header("Location: productadd.php?required=type");
				}elseif ($price == "" || $price < 0 ) {
				header("Location: productadd.php?required=price");     
				}else{
				if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
					// Proses simpan ke Database
					$code = $_POST['code'];
					$date = $_POST['date'];
					$user = $_POST['user'];

					$query = "INSERT INTO `tblproducts`(`product_name`, `price`, `date_in`, `category_id`, `user_id`, `type`, `status`,`image`,`detail_product`)
					VALUES
					('".$product."','".$price."','".$date."','".$category."','".$user."','".$type."','Tersedia','".$fotobaru."','".$detail_product."')";
					mysqli_query($db,$query)or die (mysqli_error($db));
					$sql = "UPDATE `tblautonumber` SET `end`=`end`+`increment` WHERE `desc` = 'PROD'";
					mysqli_query($db,$sql)or die (mysqli_error($db));
				?>
<script type="text/javascript">
	alert("Berhasil Ditambahkan.");
	window.location = "product.php";
</script>
<?php					
				  }else{
					// Jika gambar gagal diupload, Lakukan :
					echo "Maaf, Gambar gagal untuk diupload.";
				  }
            	
		}			
		}if ($_GET['action'] == 'update') {
		$product = $_POST['product'];
		$category = $_POST['category'];
		$type = $_POST['type'];
		$status = $_POST['status'];
		$price = $_POST['price']; 
		$id = $_POST['id'];

			if ($product == "") {
              header("Location: productupdate.php?required=product&id=".$id."");
            }elseif ($category == "") {
              header("Location: productupdate.php?required=category&id=".$id."");  
            }elseif ($type == "") {
              header("Location: productupdate.php?required=type&id=".$id."");  
			}
			elseif ($price == "") {
				header("Location: productupdate.php?required=price&id=".$id."");  
			}else{
            	$query = 'UPDATE tblproducts set product_name ="'.$product.'", price ="'.$price.'", `category_id`="'.$category.'",`type`="'.$type.'" ,`status`="'.$status.'" WHERE product_id ="'.$id.'"';
				mysqli_query($db, $query) or die(mysqli_error($db));
				
					?>
<script type="text/javascript">
	alert("Update Berhasil.");
	window.location = "product.php";
</script>
<?php
		}		
		}if ($_GET['action'] == 'updatequantity') {
		$quantity = $_POST['quantity'];
			$id = $_POST['id'];
			if (empty($quantity) || $quantity < 0) {
				header("Location: updatequantity.php?required=quant&id=".$id."");  
			}else{
				$sql = 'UPDATE tblproducts set quantity = quantity + "'.$quantity.'" WHERE product_code ="'.$id.'"';
				mysqli_query($db, $sql) or die(mysqli_error($db));
				
				$date = date('Y-m-d H:i:s');
				$uid = $_SESSION['userid'];
				$query = "INSERT INTO `tblstockhistory`(`date`, `qty`, `user_id`, `product_code`)
				VALUES ('".$date."','".$quantity."','".$uid."','".$id."')";
				mysqli_query($db,$query)or die (mysqli_error($db));
				?>
<script type="text/javascript">
	alert("Update Berhasil.");
	window.location = "product.php";
</script>
<?php
			}
		}			
		}
				?>