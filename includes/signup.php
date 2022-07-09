<?php  
if (isset($_POST['signups-submit'])) {

require 'connection.php';

$C_FNAME = $_POST['C_FNAME'];
$C_LNAME = $_POST['C_LNAME'];
$C_AGE = $_POST['C_AGE'];
$C_ADDRESSID = 0;
$C_PNUMBER = $_POST['C_PNUMBER'];
$C_GENDER = $_POST['C_GENDER'];
$C_AKSES = $_POST['C_AKSES'];
$C_EMAILADD = $_POST['C_EMAILADD'];
$ZIPCODE = 4321;
$username = $_POST['username'];
$password = $_POST['password'];
$passcon = $_POST['pwdcon'];

$hashedPwd =password_hash($password,PASSWORD_DEFAULT);

$queryCek = mysqli_query($db, 'SELECT * FROM tblcustomer WHERE username = "' . $username . '" AND C_EMAILADD = "' .
$C_EMAILADD . '"');
$cek = mysqli_num_rows($queryCek);

	if ($cek > 0) {
		echo ("<script language='JavaScript'>
			window.location.href = '../register.php';
			window.alert('username/email sudah terdaftar.')
		</script>");
	} else {
		 $instuser = "INSERT INTO tblcustomer (C_FNAME, C_LNAME, C_AGE, C_ADRESSID, C_PNUMBER, C_GENDER, C_AKSES, C_EMAILADD,
		 ZIPCODE, username, password)
		 VALUES
		 ('$C_FNAME','$C_LNAME','$C_AGE','$C_ADDRESSID','$C_PNUMBER','$C_GENDER','$C_AKSES','$C_EMAILADD','$ZIPCODE','$username','$hashedPwd')";
		 mysqli_query($db, $instuser) or die('Error, gagal menyimpan data customer');
		 echo ("<script language='JavaScript'>
		 	window.location.href = '../login.php';
		 	window.alert('Berhasil Registrasi.')
		 </script>");
	}
}
?>