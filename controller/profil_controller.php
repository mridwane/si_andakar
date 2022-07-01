<?php
include('../includes/connection.php');


session_start();
if ($_GET['action'] == 'update') {
  $cid = $_SESSION['cid'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $nowa = $_POST['nowa'];
  $email = $_POST['email'];

  //Update table transac
  $query = "UPDATE tblcustomer SET C_FNAME = '" . $fname . "', C_LNAME = '" . $lname . "', C_PNUMBER = '" . $nowa .
  "',C_EMAILADD = '" . $email . "' WHERE C_ID='" .$cid . "'";
  mysqli_query($db, $query) or die(mysqli_error($db));
  echo ("<script language='JavaScript'>
    window.location.href = '../profil.php';
    window.alert('Data anda berhasil di update')
  </script>");
}?>
<script src="../assets/js/cart.js"></script>