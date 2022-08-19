<div class="modal fade" id="update_modal<?php echo $_GET['no_regis'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Konfirmasi Kemitraan</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Registrasi</label>
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
                            <input type="text" name="regis_no" value="<?php echo $no_regis ?>" class="form-control" readonly />
                        </div>
                        <?php if ($status == 'unconfirmed') { ?>
                            <div class="form-group">
                                <label>Keputusan</label>
                                <select name="action" id="action" class="form-control first-decision">
                                    <option value="" disabled selected> Pilih Keputusan </option>
                                    <option value="interview" data-names="accepted">Terima Wawancara</option>
                                    <option value="denied" data-names="denied">Tolak</option>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group tanggal-interview" hidden>
                                <label>Tanggal Interview</label>
                                <input type="date" name="tgl" class="form-control" />
                            </div>
                            <div class="form-group jam-interview" hidden>
                                <label>Waktu Interview</label>
                                <input type="time" name="waktu" class="form-control" />
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <label>Keputusan</label>
                                <select name="action" id="action" class="form-control nice-select wide">
                                    <option value="" disabled selected> Pilih Keputusan </option>
                                    <option value="active" data-names="accepted">Terima Sebagai Mitra</option>
                                    <option value="denied" data-names="denied">Tolak</option>
                                    </option>
                                </select>
                                <br>
                                <label for="upload">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" id="bukti_tf" name="bukti_tf" accept=".jpeg, .jpg, .png">
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <?php if ($status == 'unconfirmed') { ?>
                        <button name="simpan1" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <?php } else { ?>
                        <button name="simpan2" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <?php } ?>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<?php
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../includes/connection.php');
    if (isset($_POST['simpan1'])) {
        $status = $_POST['action'];
        $regis_no = $_POST['regis_no'];
        $date = $_POST['tgl'];
        $time = $_POST['waktu'];
        $note = $_POST['note'];
        $user_id = $_POST['user_id'];
        $catatan = "Selamat anda kami undang untuk Interview di perusahaan kami pada tanggal " . $date . " Pukul " . $time . " Catatan: " . $note;

        // update table request
        $query_update = "UPDATE tblrequestmitra SET status = '" . $status . "', note = '" . $catatan . "' WHERE
        regis_no='" . $regis_no . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
        // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
        // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
        <script type="text/javascript">
            window.location.href = 'list_kemitraan_admin.php';
            alert('Data Berhasil Disimpan');
        </script>
    <?php
    } else if (isset($_POST['simpan2'])) {
        $status = $_POST['action'];
        $regis_no = $_POST['regis_no'];
        $datetime = date('Y-m-d H:i:s');
        $note = $_POST['note'];
        $user_id = $_POST['user_id'];
        // update table request
        $query_update = "UPDATE tblrequestmitra SET status = '" . $status . "', note = '" . $note . "' WHERE regis_no='" . $regis_no . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        $file = $_FILES['bukti_tf']['name'];
        $tmp = $_FILES['bukti_tf']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = "BTMTR" . $regis_no . "." . $type;
        // Set path folder tempat menyimpan fotonya
        $path = "../assets/bukti_transfer/" . $filenew;



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
            $status_transfer = "diterima";
            $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
        VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', '', 'admin','','', '" . $regis_no . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }
    ?>
        <script type="text/javascript">
            window.location.href = 'list_kemitraan_admin.php';
            alert('Data Berhasil Disimpan');
        </script>
<?php
    }
}
?>

<script>
    $(document).ready(function() {

        $('.first-decision').on('click', function() {
            const value = $(this).find(':selected').val();
            console.log(value)
            if (value == "interview") {
                $('.tanggal-interview').removeAttr('hidden');
                $('.jam-interview').removeAttr('hidden');
            } else {
                $('.tanggal-interview').attr('hidden', 'hidden');
                $('.jam-interview').attr('hidden', 'hidden');
            }
            // var priceMenu = $(this).find(':selected').data('pricem');
            // var id = $(this).find(':selected').data('id');
            // let total = priceSaus + priceMenu;
            // $('.addCart').attr("data-price", total);
            // $('.addCart').attr("data-kd-saus", id);
            // $('.addCart').removeAttr('disabled');
        });

    });
</script>