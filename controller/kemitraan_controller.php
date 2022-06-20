<?php
include('../includes/connection.php');
session_start();
if (isset($_POST['submit'])) {
    if ($_FILES['upload']['name'] != "") {

        $random = rand(10, 100);
        $tgl = date("dmYhis");
        $no_regis = "MITREG" . $tgl . $random;
        $tanggal = date('Y-m-d H:i:s');
        // get file
        $file = $_FILES['upload']['name'];
        $tmp = $_FILES['upload']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = $no_regis . "_" . $user_id . "_kemitraan." . $type;
        // Set path folder tempat menyimpan fotonya
        $path = "../assets/file_kemitraan/" . $filenew;



        // Cek apakah gambar berhasil diupload atau tidak
        $status = false;
        if (move_uploaded_file($tmp, $path)) {
            copy($path, $path);
        }
        if ($status == false) {

            // Proses simpan ke Database

            $nama = "";

            if ($type != "") {
                $nama = $filenew;
            }

            $query = "INSERT INTO `tblrequestmitra`(`regis_no`, `date_req`, `file`, `status`, `c_id`)
            VALUES ('" . $no_regis . "','" . $tanggal . "','" . $nama . "','pengajuan','" . $user_id . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));

?>
            <script type="text/javascript">
                alert("Data Pengajuan Kemitraan berhasil disimpan, mohon menunggu untuk kami konfirmasi");
                window.location = "../kemitraan.php";
            </script>
        <?php

        } else {
            // Jika gambar gagal diupload, Lakukan :
            echo "Maaf, file gagal untuk diupload.";
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Silahkan pilih file terlebih dahulu untuk di upload");
            window.location = "../kemitraan.php";
        </script>
<?php
    }
}

?>