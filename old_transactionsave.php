<?php
include "includes/connection.php";
  session_start();

  $del = $_POST['del'];             
    $query = 'SELECT current_date FROM tblusers';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
      while($row = mysqli_fetch_array($result))
      {   
        $date = $row['current_date'];
      }
      $tat=time();
      if($_GET["action"]=='adds') {
        foreach($_SESSION['cart'] as $id => $value) {
            //Save Transaction
     $query1 = "INSERT INTO tbltransac(transac_code,date,customer_id,product_code,qty)values('".$tat."','".$date."','".$_SESSION['cid']."','".$value['ids']."','".$value['quantity']."')"; 
     mysqli_query($db,$query1)or die(mysqli_error($db));
     
    //  $query3 = "INSERT INTO tblpot(size,transac_code)values('".$value['pot']."','".$tat."')"; 
    //  mysqli_query($db,$query3)or die(mysqli_error($db));

     //Update Product
     $query2 = "UPDATE tblproducts SET quantity = quantity - '".$value['quantity']."' WHERE product_code='".$value['ids']."'";
     mysqli_query($db,$query2)or die(mysqli_error($db));
  }
  //Save Transaction Detail 
  // $met = $_POST['paymethod'];
  // $totalbiaya = 0;
  // $fee = 0;
  // if($met == "COD"){
  //   $totalbiaya = $_SESSION['mm'] + 10000;
  //   $fee = 10000;
  // }else{
  //   $totalbiaya = $_SESSION['mm'];
  //   $fee=0;
  // }
  $query3 = "INSERT INTO tbltransacdetail(transac_code,date,customer_id,status,delivery_date)VALUES('".$tat."','".$date."','".$_SESSION['cid']."','Pending','".$del."')";
  mysqli_query($db,$query3)or die(mysqli_error($db)); 


  
}
							
						 unset($_SESSION["cart"]);
             unset($_SESSION['mm']);	
				?>

<script type="text/javascript">
  alert("Pemesanan Berhasil Disimapn");
  window.location = "order.php";
</script>