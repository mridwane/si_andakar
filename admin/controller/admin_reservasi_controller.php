<!-- modal jika ada ketidaksesuaian transfer -->

<div class="modal fade" id="update_modal<?php echo $_GET['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Ketidaksesuaian Transfer</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Pemesanan</label>
                            <input type="text" name="transac_code" value="<?php echo $_GET['id'] ?>"
                                class="form-control" readonly />
                            <input type="text" name="status" value="<?php echo $stats ?>" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Seharusnya</label>
                            <input type="text" name="transfer_seharusnya" id="transfer_seharusnya"
                                value="<?php echo number_format(($subtotal + $pajak) / 2) ?>" class="form-control"
                                readonly />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Customer</label>
                            <input type="number" name="cust_transfer" id="cust_transfer" class="form-control"
                                onkeyup="validateTransfer();" />
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <span id="count"></span>
                            <input type="number" name="margin" id="margin" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label for="upload">Upload Bukti Transfer Pengembalian (total transfer sesuai dengan Nominal
                                Transfer Customer)</label>
                            <input type="file" class="form-control" id="upload_pengembalian" name="upload_pengembalian"
                                accept=".jpeg, .jpg, .png">
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="submit" name="save_ketidaksesuaian" id="save_ketidaksesuaian"
                        class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<!-- dp modal -->

<div class="modal fade" id="dp_modal<?php echo $_GET['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="controller/admin_reservasi_controller.php?no_transac=<?php echo $_GET['id']; ?>&action=dp">
                <div class="modal-header">
                    <h3 class="modal-title">Terima Pesanan</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Pemesanan</label>
                            <input type="text" name="transac_code" value="<?php echo $_GET['id'] ?>"
                                class="form-control" readonly />
                            <input type="text" name="status" value="<?php echo $stats ?>" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Seharusnya</label>
                            <input type="text" name="transfer_seharusnya" id="transfer_seharusnya" value="<?php echo number_format(($total) / 2) ?>" class="form-control" readonly />
                            <input type="text" value="<?= ($total) / 2 ?>" class="form-control nominal" hidden />
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transfer</label>
                            <input type="number" name="cust_transfer" id="cust_transfer" class="form-control cust_transfer" required="required"/>
                        </div>                      
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control note" required="required"></textarea>
                        </div>                        
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"><span
                            class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<!-- accept modal -->

<div class="modal fade" id="accept_modal<?php echo $_GET['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="controller/admin_reservasi_controller.php?no_transac=<?php echo $_GET['id']; ?>&action=accept">
                <div class="modal-header">
                    <h3 class="modal-title">Buat Pesanan</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Pemesanan</label>
                            <input type="text" name="transac_code" value="<?php echo $_GET['id'] ?>"
                                class="form-control" readonly />
                            <input type="text" name="status" value="<?php echo $stats ?>" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Seharusnya</label>
                            <input type="text" name="transfer_seharusnya" id="transfer_seharusnya" value="<?php echo number_format($sisa) ?>" class="form-control" readonly />
                            <input type="text" value="<?= $sisa ?>" class="form-control nominal-sisa" hidden />
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transfer</label>
                            <input type="number" name="cust_transfer_sisa" id="cust_transfer_sisa" class="form-control cust_transfer_sisa" required="required"/>
                        </div>                      
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea type="text" name="note" class="form-control note" required="required"></textarea>
                        </div>                        
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"><span
                            class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<!-- modal untuk tolak pesanan -->
<div class="modal fade" id="deny_modal<?php echo $_GET['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Tolak pesanan - Pengembalian Dana</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>No Pemesanan</label>
                            <input type="text" name="transac_code" value="<?php echo $_GET['id'] ?>"
                                class="form-control" readonly />
                            <input type="text" name="status" value="<?php echo $stats ?>" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Seharusnya</label>
                            <input type="text" name="transfer_seharusnya" id="transfer_seharusnya"
                                value="<?php echo number_format(($total) / 2) ?>" class="form-control"
                                readonly />
                        </div>
                        <div class="form-group">
                            <label>Nominal Transfer Customer</label>
                            <input type="number" name="cust_transfer" id="cust_transfer" class="form-control"
                                onkeyup="validateTransfer();" />
                        </div>
                        <div class="form-group">
                            <label>Alasan Penolakan</label>
                            <textarea type="text" name="note" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <span id="count"></span>
                            <input type="number" name="margin" id="margin" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <label for="upload">Upload Bukti Transfer Pengembalian (total transfer sesuai dengan Nominal
                                Transfer Customer)</label>
                            <input type="file" class="form-control" id="upload_pengembalian" name="upload_pengembalian"
                                accept=".jpeg, .jpg, .png">
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="submit" name="save_deny" id="save_deny" class="btn btn-warning"><span
                            class="glyphicon glyphicon-edit"></span>Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel</button>
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
        document.getElementById('margin').value = parseInt(cust_tramsfer.replace(/[^0-9]/g, '')) - parseInt(
            transfer_seharusnya.replace(/[^0-9]/g, ''));
        if (count < 0) {
            count_string = Math.abs(count)
            document.getElementById('count').innerHTML = "Lebih " + count_string.toLocaleString('en-US');
            document.getElementById("simpan").disabled = false;
        } else if (count > 0) {
            count_string = Math.abs(count)
            document.getElementById('count').innerHTML = "Kurang " + count.toLocaleString('en-US');
            document.getElementById("simpan").disabled = false;
        } else if (count == 0 || count == "" || isNaN(count)) {
            count_string = Math.abs(count)
            document.getElementById('count').innerHTML = "Kurang " + transfer_seharusnya.toLocaleString('en-US');
            document.getElementById("simpan").disabled = false;
        } else {
            document.getElementById('count').innerHTML = "Sesuai";
            document.getElementById("simpan").disabled = true;
        }
    }

    $(document).ready(function () {

        // converter mata uang
        const Rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number);
        }

        $('.cust_transfer').keyup(function() {            
            var input = $(this).val();
            var nominal = $('.nominal').val();
            var hasil = parseInt(input) - parseInt(nominal);

            if(hasil < 0){
                $('.note').text("Jumlah Pembayaran Kurang " + Rupiah(hasil));
            }
            else if(hasil > 0){
                $('.note').text("Jumlah Pembayaran Lebih " + Rupiah(hasil));
            }
            else {
                $('.note').text("transfer Sesuai.");
            }            
        });

        $('.cust_transfer_sisa').keyup(function() {            
            var input = $(this).val();
            var nominal = $('.nominal-sisa').val();
            var hasil = parseInt(input) - parseInt(nominal);

            if(hasil < 0){
                $('.note').text("Jumlah Pembayaran Kurang " + Rupiah(hasil));
            }
            else if(hasil > 0){
                $('.note').text("Jumlah Pembayaran Lebih " + Rupiah(hasil));
            }
            else {
                $('.note').text("transfer Sesuai.");
            }

            
        });

    });
</script>



<?php

if (isset($_GET['no_transac']) && $_GET['action'] == "confirm") {
    require_once('../../includes/connection.php');
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
    window.location.href = '../detailtransac_reservasi.php?id=<?php echo $no_transac ?>';
    alert("Pesanan Telah Dikonfirmasi");
</script>
<?php

}

if (isset($_GET['no_transac']) && $_GET['action'] == "lunas") {
    require_once('../../includes/connection.php');
    $status = "lunas";
    $no_transac = $_GET['no_transac'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
<script type="text/javascript">
    window.location.href = '../detailtransac_reservasi.php?id=<?php echo $no_transac ?>';
    alert("Pesanan Telah Dikonfirmasi");
</script>
<?php

}

if (isset($_GET['no_transac']) && $_GET['action'] == "deny") {
    require_once('../../includes/connection.php');
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
    window.location.href = '../detailtransac_reservasi.php?id=<?php echo $no_transac ?>';
    alert("Pesanan Telah Ditolak/Dibatalkan");
</script>
<?php

}

if (isset($_GET['no_transac']) && $_GET['action'] == "dp") {
    require_once('../../includes/connection.php');
    $status = "confirmed";
    $no_transac = $_GET['no_transac'];
    $dp = $_POST['cust_transfer'];
    $catatan = $_POST['note'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "', dp = '" . $dp . "', catatan = '" . $catatan . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
<script type="text/javascript">
    window.location.href = '../detailtransac_reservasi.php?id=<?php echo $no_transac ?>';
    alert("Pesanan Telah Diterima, menunggu customer membayar pelunasan.");
</script>
<?php

}

if (isset($_GET['no_transac']) && $_GET['action'] == "accept") {
    require_once('../../includes/connection.php');
    $status = "done";
    $no_transac = $_GET['no_transac'];
    $pelunasan = $_POST['cust_transfer_sisa'];
    $catatan = $_POST['note'];
    // update table transac
    $query_update = "UPDATE tbltransac SET status = '" . $status . "', pelunasan = '" . $pelunasan . "', catatan = '" . $catatan . "' WHERE transac_code='" . $_GET['no_transac'] . "'";
    mysqli_query($db, $query_update) or die(mysqli_error($db));


    // //insert ke table detail, berfungsi untuk melihat hisoty siapa yang accept atau dengan alesan apa
    // $query_insert = "INSERT INTO tbldetailrequestmitra(date,note,status,user_id)values('" . $datetime . "','" . $note . "','" . $status . "','" . $user_id . "')";
    // mysqli_query($db, $query_insert) or die(mysqli_error($db));
?>
<script type="text/javascript">
    window.location.href = '../detailtransac_reservasi.php?id=<?php echo $no_transac ?>';
    alert("Pesanan Telah Selesai, silahkan membuat pesanan untuk reservasi.");
</script>
<?php

}







// tombol save untuk pengembalian transfer ketika pesanan ditolak
if (isset($_POST['save_deny'])) {
    if ($_POST["status"] == "dp" || $_POST["status"] == "after_revision") {
        $transac_code = $_POST["transac_code"];
        $status = "revisi_dp";
        $note = $_POST["note"];
        $nominal_customer_trf = $_POST["cust_transfer"];
        $margin = $_POST["margin"];

        // insert bukti transfer dari admin
        // get file
        $file = $_FILES['upload_pengembalian']['name'];
        $tmp = $_FILES['upload_pengembalian']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = "BTDP" . $transac_code . "." . $type;
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
            $status_transfer = "deny_adm_dp";
            $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
        VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', '" . $nominal_customer_trf . "', 'admin','','', '" . $transac_code . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }

        // update tblbuktitrasnfer untuk bukti transfer customer
        $query_update = "UPDATE tblbuktitransfer SET status = 'deny_adm_dp', nominal_trf = '" . $nominal_customer_trf . "', margin = '" . $margin . "', note = '" . $note . "' WHERE
            no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update tbltransac
        $query_transac = "UPDATE tbltransac SET status = 'deny_adm_dp' WHERE
            transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_transac) or die(mysqli_error($db));
    }
    if ($_POST["status"] == "pelunasan" || $_POST["status"] == "after_revision_lns") {
        $transac_code = $_POST["transac_code"];
        $status = "deny_lns";
        $note = $_POST["note"];
        $nominal_customer_trf = $_POST["cust_transfer"];
        $margin = $_POST["margin"];

        // insert bukti transfer dari admin
        // get file
        $file = $_FILES['upload_pengembalian']['name'];
        $tmp = $_FILES['upload_pengembalian']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = "BTREVLNS" . $transac_code . "." . $type;
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
            $status_transfer = "deny_adm_lns";
            $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
        VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', '" . $nominal_customer_trf . "', 'admin','','', '" . $transac_code . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }

        // update tblbuktitrasnfer untuk bukti transfer customer
        $query_update = "UPDATE tblbuktitransfer SET status = 'deny_adm_lns', nominal_trf = '" . $nominal_customer_trf . "', margin = '" . $margin . "', note = '" . $note . "' WHERE
            no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update tbltransac
        $query_transac = "UPDATE tbltransac SET status = 'deny_adm_lns' WHERE
            transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_transac) or die(mysqli_error($db));
    }



?>
<script type="text/javascript">
    window.location.href = 'detailtransac_reservasi.php?id=<?php echo $transac_code ?>';
    alert('Data Berhasil Disimpan');
</script>
<?php

}


// tombol save untuk transfer yang tidak sesuai namun pesanan tidak di batalkan
if (isset($_POST['save_ketidaksesuaian'])) {
    if ($_POST["status"] == "dp") {
        $transac_code = $_POST["transac_code"];
        $status = "revisi_dp";
        $note = $_POST["note"];
        $nominal_customer_trf = $_POST["cust_transfer"];
        $margin = $_POST["margin"];

        // insert bukti transfer dari admin
        // get file
        $file = $_FILES['upload_pengembalian']['name'];
        $tmp = $_FILES['upload_pengembalian']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = "BTDP" . $transac_code . "." . $type;
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
            $status_transfer = "revisi_dp";
            $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
        VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', '" . $nominal_customer_trf . "', 'admin','','', '" . $transac_code . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }

        // update tblbuktitrasnfer untuk bukti transfer customer
        $query_update = "UPDATE tblbuktitransfer SET status = 'revisi_dp', nominal_trf = '" . $nominal_customer_trf . "', margin = '" . $margin . "', note = '" . $note . "' WHERE
            no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update tbltransac
        $query_transac = "UPDATE tbltransac SET status = 'revisi_dp' WHERE
            transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_transac) or die(mysqli_error($db));
    }
    if ($_POST["status"] == "pelunasan") {
        $transac_code = $_POST["transac_code"];
        $status = "revisi_dp";
        $note = $_POST["note"];
        $nominal_customer_trf = $_POST["cust_transfer"];
        $margin = $_POST["margin"];

        // insert bukti transfer dari admin
        // get file
        $file = $_FILES['upload_pengembalian']['name'];
        $tmp = $_FILES['upload_pengembalian']['tmp_name'];
        $type = pathinfo($file, PATHINFO_EXTENSION);

        $user_id = $_SESSION['cid'];


        // Rename nama file
        $filenew = "BTREVLNS" . $transac_code . "." . $type;
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
            $status_transfer = "revisi_pelunasan";
            $query = "INSERT INTO `tblbuktitransfer`(`date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`)
        VALUES ('" . $datetime . "','" . $nama . "','" . $status_transfer . "', '" . $nominal_customer_trf . "', 'admin','','', '" . $transac_code . "')";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }

        // update tblbuktitrasnfer untuk bukti transfer customer
        $query_update = "UPDATE tblbuktitransfer SET status = 'revisi_pelunasan', nominal_trf = '" . $nominal_customer_trf . "', margin = '" . $margin . "', note = '" . $note . "' WHERE
            no_transac='" . $transac_code . "' AND user='customer'";
        mysqli_query($db, $query_update) or die(mysqli_error($db));

        // update tbltransac
        $query_transac = "UPDATE tbltransac SET status = 'revisi_pelunasan' WHERE
            transac_code='" . $transac_code . "'";
        mysqli_query($db, $query_transac) or die(mysqli_error($db));
    }



?>
<script type="text/javascript">
    window.location.href = 'detailtransac_reservasi.php?id=<?php echo $transac_code ?>';
    alert('Data Berhasil Disimpan');
</script>
<?php

}

?>


