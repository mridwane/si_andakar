<!-- cron ini akan dijalankan di server -->
<?php
include('includes/connection.php');
$query = 'SELECT * FROM tbltransac WHERE transac_type = "Reservasi" or transac_type = "Catering"';

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$date = date("Y-m-d");
while ($row = mysqli_fetch_array($result)) {
    if ($row["status"] != "done" && $row["status"] != "lunas") {
        if ($row["transac_type"] == "Reservasi") {
            if (date("d", strtotime($row["reservation_date_time"])) - date("d", strtotime($date)) < 0) {
                $query2 = "UPDATE tbltransac SET status = 'cancel' WHERE transac_code='" . $row['transac_code'] . "'";
                mysqli_query($db, $query2) or die(mysqli_error($db));
                echo $row['transac_code'] . " berhasil di batalkan" . "<br>";
            }
        } else if ($row["transac_type"] == "Catering") {

            if (date("d", strtotime($row["reservation_date_time"])) - date("d", strtotime($date)) < 2) {
                $query3 = "UPDATE tbltransac SET status = 'cancel' WHERE transac_code='" . $row['transac_code'] . "'";
                mysqli_query($db, $query3) or die(mysqli_error($db));
                echo $row['transac_code'] . " berhasil di batalkan" . "<br>";
            }
        }
    }
}
