 <?php 

session_start();
session_unset($_SESSION['userid']);
session_unset($_SESSION['fname']);
session_unset($_SESSION['lname']);
session_unset($_SESSION['position']);
session_unset($_SESSION['useruid']);
session_unset($_SESSION['email']);
session_destroy();
header("Location: ../login.php");
?>