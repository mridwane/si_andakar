<div class="modal fade" id="update_modal<?php echo $_GET['no_regis'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
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
                        <div class="form-group">
                            <label>Keputusan</label>
                            <select name="action" id="action" class="form-control nice-select wide">
                                <option value="" disabled selected> Pilih Keputusan </option>
                                <option value="accepted" data-names="accepted">Terima</option>
                                <option value="denied" data-names="denied">Tolak</option>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button name="simpan" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
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
    if (isset($_POST['simpan'])) {
        $status = $_POST['action'];
        $regis_no = $_POST['regis_no'];
        $datetime = date('Y-m-d H:i:s');
        $note = $_POST['note'];
        $user_id = $_POST['user_id'];

        // update table request
        $query_update = "UPDATE tblrequestmitra SET status = '" . $status . "' WHERE regis_no='" . $regis_no . "'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));


        //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
        $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
        mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
        <script type="text/javascript">
            window.location.href = 'list_kemitraan_admin.php';
            alert('Data Berhasil Disimpan');
        </script>
<?php
    }
}
?>