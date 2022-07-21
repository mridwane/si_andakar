<?php
include('../../includes/connection.php');


// session_start();
if ($_GET['action'] == 'nonactive') {
  $status = "nonactive";
  $no_regis = $_GET['no_regis'];

  $query_update = "UPDATE tblrequestmitra SET status = '" . $status . "' WHERE regis_no='" . $no_regis . "'";
  mysqli_query($db, $query_update) or die(mysqli_error($db));

  echo ("<script type='text/javascript'>
    window.location.href = '../list_kemitraan_diterima.php';
    alert('Kemitraan Berhasil dinonaktifkan');
  </script>");
}
else if ($_GET['action'] == 'active') {
  $status = "active";
  $no_regis = $_GET['no_regis'];

  $query_update = "UPDATE tblrequestmitra SET status = '" . $status . "' WHERE regis_no='" . $no_regis . "'";
  mysqli_query($db, $query_update) or die(mysqli_error($db));

  echo ("<script type='text/javascript'>
    window.location.href = '../list_kemitraan_diterima.php';
    alert('Kemitraan Berhasil diaktifkan');
  </script>");
}
?>
<script src="../assets/js/cart.js"></script>