<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';

$query = 'SELECT * ,concat(b.`fname`," ",b.`lname`)as name FROM `tblreq` a inner join `tblusers` b on
a.`user_id` = b.`user_id` WHERE
a.`no_permintaan` = '.$_GET['no_permintaan'].' ';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
while($row = mysqli_fetch_array($result))
{
$no_permintaan = $row['no_permintaan'];
$name = $row['name'];
$tgl_input = $row['tgl_input'];
$status = $row['status'];
$pecah = explode('-', $tgl_input);
$tgl = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
}
?>
<style type="text/css">
    .error-msg {
        text-align: center;
        font-weight: bold;
    }
</style>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5>No Permintaan:</h5>
                </div>
                <div class="col-8">
                    <h5> <b><?= $no_permintaan ?></b></h5>
                    <!-- untuk ngirim data no permintaan ke JS -->
                    <input type="text" id="no_permintaan" value="<?= $no_permintaan ?>" hidden>
                </div>
                <div class="col-4">
                    <h5>Nama:</h5>
                </div>
                <div class="col-8">
                    <h5> <b><?= $name ?></b></h5>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5>Tanggal:</h5>
                </div>
                <div class="col-8">
                    <h5> <b><?= $tgl ?></b></h5>
                </div>
                <div class="col-4">
                    <h5>Permintaan:</h5>
                </div>
                <?php if($status == 0) {?>
                <div class="col-8">
                    <a href="#" class="setuju btn btn-primary" type="button" data-status="1">Setujui</a>
                    <a href="#" class="batal btn btn-danger" type="button" data-status="2">Batalkan</a>
                </div>
                <?php } elseif ($status == 1) { ?>
                <div class="row">
                    <div class="col-4">
                        <h5>Disetujui</h5>
                    </div>
                    <div class="col-8">
                        <a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Cetak
                            Bukti Permintaan</a>
                    </div>
                </div>
                <?php } else {
                    echo "<h5>Dibatalkan</h5>";
                }
                ?>
            </div>
            <button class="btn btn-warning" onclick="history.back()">Kembali</button>
        </div>
    </div>
    <br>
    <div class="card card-register mx-auto mt-2">
        <div class="card-header">Detail List Permintaan Barang</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                            $query = 'SELECT * FROM `tblreqdetail` a inner join `tblproducts` b on a.`product_code` = b.`product_code` WHERE a.`no_permintaan` = '.$_GET['no_permintaan'].' ';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            // membuat nomer otomatis untuk di tabel
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                // cek Status Pending atau disetujui
                                echo '<tr>';
                                echo '<td>'. $no++.'</td>';
                                echo '<td>'. $row['product_name'].'</td>';
                                echo '<td>'. $row['qty'].'</td>';
                                echo '</tr> ';
                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Page untuk cetak Permintaan -->
<span id="divToPrint" hidden>
    <div class="card mb-3">
        <div class="card-header">
            <center>
                <h2>Permintaan Barang</h2>
            </center>
            <div class="card-body">
                <div class="table-responsive">
                    <p>No. Permintaan : <b><?= $no_permintaan ?></b></p></br>
                    <table cellpadding="4" width="100%" cellspacing="0" border="1">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php        
                                 $query = 'SELECT * FROM `tblreqdetail` a inner join `tblproducts` b on a.`product_code` = b.`product_code` WHERE a.`no_permintaan` = '.$_GET['no_permintaan'].' ';
                                $result = mysqli_query($db, $query) or die (mysqli_error($db));  
                                $no = 1;      
                                while ($row = mysqli_fetch_assoc($result)) {
                                            
                                echo '<tr align="center">';
                                echo '<td>'. $no++.'</td>';
                                echo '<td>'. $row['product_code'].'</td>';      
                                echo '<td>'. $row['product_name'].'</td>';
                                echo '<td>'. $row['qty'].'</td>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</span>

<!--footer area-->
<?php include 'theme/footer.php'; }?>

<script src="js/custom-js/persetujuan.js"></script>
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=800,height=800');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>