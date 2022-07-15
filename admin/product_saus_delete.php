<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';

$query = 'DELETE FROM tblsaus WHERE id_saus = "'.$_GET['id'].'" ';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
echo '<script type="text/javascript">
  alert("Menu berhasil di hapus.");
  window.location = "product_saus.php";
</script>';
                         
?>
<!--footer area-->
<?php include 'theme/footer.php'; }?>