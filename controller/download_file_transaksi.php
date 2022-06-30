<?php
include('../includes/connection.php');
// Downloads files
if (isset($_GET['file_name'])) {
    $no_transac = $_GET['no_transac'];
    $file_name = $_GET['file_name'];


    // // fetch file to download from database
    // $sql = 'SELECT * FROM daftar_proposal WHERE no_proposal="PRPSL_1003" AND file_rencana_tahapan = "PRPSL_1003_1001_rencana_tahapan.pdf"';
    // $result = mysqli_query($db, $sql);

    // $file = mysqli_fetch_assoc($result);

    $filepath = '../assets/bukti_transfer/' . $file_name;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../assets/bukti_transfer/' . $file_name));
        readfile('../assets/bukti_transfer/' . $file_name);

        exit;
    }
}
