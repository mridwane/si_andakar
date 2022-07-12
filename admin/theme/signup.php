<?php  
if (isset($_POST['signups-submit'])) {

require 'connection.php';

$C_FNAME = $_POST['C_FNAME'];
$C_LNAME = $_POST['C_LNAME'];
$C_ADDRESSID = 0;
$C_PNUMBER = $_POST['C_PNUMBER'];
$C_AKSES = $_POST['C_ROLE'];
$C_EMAILADD = $_POST['C_EMAILADD'];
$username = $_POST['username'];
$password = $_POST['password'];
$passcon = $_POST['pwdcon'];

$hashedPwd =password_hash($password,PASSWORD_DEFAULT);

$queryCek = mysqli_query($db, 'SELECT * FROM tblusers WHERE username = "' . $username . '" AND email = "' .
$C_EMAILADD . '"');
$cek = mysqli_num_rows($queryCek);

	if ($cek > 0) {
		echo ("<script language='JavaScript'>
			window.location.href = '../register.php';
			window.alert('username/email sudah terdaftar.')
		</script>");
	} else {
		 $instuser = "INSERT INTO tblusers (fname, lname, email, contact, address, position, username, pass)
		 VALUES
		 ('$C_FNAME','$C_LNAME','$C_EMAILADD','$C_PNUMBER','$C_ADDRESSID','$C_AKSES','$username','$hashedPwd')";
		 mysqli_query($db, $instuser) or die('Error, gagal menyimpan data customer');
		 echo ("<script language='JavaScript'>
		 	window.location.href = '../login.php';
		 	window.alert('Berhasil Registrasi.')
		 </script>");
	}
}
?>