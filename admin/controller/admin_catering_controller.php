<div class="modal fade" id="update_modal<?php echo $_GET['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h3 class="modal-title">Ketidaksesuaian Transfer</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Pemesanan</label>
                            <input type="text" name="regis_no" value="<?php echo $_GET['id'] ?>" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Seharusnya</label>
                            <input type="text" name="transfer_seharusnya" id="transfer_seharusnya" value="<?php echo number_format(($subtotal + $pajak + $service) / 2) ?>" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Customer</label>
                            <input type="text" name="cust_transfer" id="cust_transfer" class="form-control" onkeyup="validateTransfer();" />
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <span id="count"></span>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button name="simpan" id="simpan" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    function validateTransfer() {
        var transfer_seharusnya = document.getElementById("transfer_seharusnya").value;
        var cust_tramsfer = document.getElementById("cust_transfer").value;
        var count = parseInt(transfer_seharusnya.replace(/[^0-9]/g, '')) - parseInt(cust_tramsfer);
        if (count < 0) {
            count_string = Math.abs(count)
            document.getElementById('count').innerHTML = "Lebih " + count_string.toLocaleString('en-US');
            document.getElementById("simpan").disabled = false;
        } else if (count > 0) {
            count_string = Math.abs(count)
            document.getElementById('count').innerHTML = "Kurang " + count.toLocaleString('en-US');
            document.getElementById("simpan").disabled = false;
        } else {
            document.getElementById('count').innerHTML = "Sesuai";
            document.getElementById("simpan").disabled = true;
        }


    }
</script>

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
        alert("Pesanan Telah Dikonfirmasi");
    </script>
<?php
    header('Location: ../detailtransac.php?id=' . $no_transac);
}

if (isset($_GET['no_transac']) && $_GET['action'] == "deny") {
    $status = "deny";
    $no_transac = $_GET['no_transac'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
    <script type="text/javascript">
        alert("Pesanan Telah Ditolak");
    </script>
<?php
    header('Location: ../detailtransac.php?id=' . $no_transac);
}


?>