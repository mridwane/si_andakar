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
}

if ($_GET['action'] == 'save_address') {
  $cid = $_SESSION['cid'];
  $select_alamat = $_POST['select_alamat'];

  //Update table transac
  $query = "UPDATE tblcustomer SET C_ADRESSID = '" . $select_alamat . "' WHERE C_ID='" .$cid . "'";
  mysqli_query($db, $query) or die(mysqli_error($db));

  echo ("<script language='JavaScript'>
    window.location.href = '../profil_alamat.php';
    window.alert('Alamat berhasil dipilih')
  </script>");
}


elseif ($_GET['action'] == 'add_address') {
  $cid = $_SESSION['cid'];
  $address = $_POST['address'];

  //Update table transac
  $query = "INSERT INTO tblalamat (alamat, c_id)
  VALUES ('$address','$cid')";
  mysqli_query($db, $query) or die('Error, gagal simpan alamat');

  echo ("<script language='JavaScript'>
    window.location.href = '../profil_alamat.php';
    window.alert('Behasil menambahkan alamat')
  </script>");
}


elseif ($_GET['action'] == 'edit_address') {
  $id_alamat = $_GET['id'];
  $address = $_POST['address'];

  //Update table transac
  $query = "UPDATE tblalamat SET alamat = '".$address."' WHERE id_alamat = '".$id_alamat."'";
  mysqli_query($db, $query) or die('Error, gagal simpan alamat');

  echo ("<script language='JavaScript'>
    window.location.href = '../profil_alamat.php';
    window.alert('Alamat berhasil di update')
  </script>");
}


elseif ($_GET['action'] == 'delete_address') {
  $id_alamat = $_GET['id'];

  //Update table transac
  $query = 'DELETE From tblalamat WHERE id_alamat = "'.$id_alamat.'"';
  mysqli_query($db, $query) or die('Error, gagal hapus alamat');

  echo ("<script language='JavaScript'>
    window.location.href = '../profil_alamat.php';
    window.alert('Alamat telah dihapus')
  </script>");
}



?>