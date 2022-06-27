<?php

include('../../includes/connection.php');
if (isset($_GET['no_transac']) && $_GET['action'] == "confirm") {
    $status = "confirmed";
    $no_transac = $_GET['no_transac'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
    <script type="text/javascript">
        alert("Pesanan Telah Dikonfirmasi, Jika order akan dikirimkan silahkan pilih tombol Kirimkan Pesanan");
    </script>
<?php
    header('Location: ../detailtransac.php?id=' . $no_transac);
}

if (isset($_GET['no_transac']) && $_GET['action'] == "send") {
    $status = "sending";
    $no_transac = $_GET['no_transac'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
    <script type="text/javascript">
        alert('Sukses! Silahkan kirimkan pesanan, pemesan akan mendapatkan notifikasi bahwa pesanan sedang menuju ke alamat tujuan')
    </script>
<?php
    header('Location: ../detailtransac.php?id=' . $no_transac);
}

?>