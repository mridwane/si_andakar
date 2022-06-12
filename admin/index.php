<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
 include 'theme/header.php';
include 'theme/sidebar.php';
if (isset($_SESSION['userid'])) {
    if ($_SESSION['position']=='Admin') {
        include 'theme/breadcrumbs.php';
    }else{
        ?><script>
            window.location = "delivery.php"
        </script>
        <?php
    }
}
include 'theme/footer.php';

}
 ?>

