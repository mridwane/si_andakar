<?php       
  session_start();
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }else{
    include('../includes/connection.php');
    include 'theme/header.php';
    include 'theme/sidebar.php';
  } 

  $no_permintaan = $_POST['no_permintaan'];
  $status = $_POST['status'];

  $query = 'UPDATE tblreq SET status = '.$status.' WHERE no_permintaan = '.$no_permintaan.'';
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>

<!-- <script type="text/javascript">
    alert("Permintaan Telah Disetujui.");
    window.location = "list_permintaan_barang.php";
</script> -->