<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';
?>
<!-- Product Tables -->
<div class="card mb-3">
    <div class="card-header">
        <h3>List Permintaan Barang
        </h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah Barang</th>
                            <th>Jumlah Total</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                            $query = 'SELECT * ,concat(b.`fname`," ",b.`lname`)as name FROM tblreq a inner join tblusers b on a.`user_id` = b.`user_id`';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            // membuat nomer otomatis untuk di tabel
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                // cek Status Pending atau disetujui
                                if($row['status'] == "0") {
                                    $status = "Pending";
                                } elseif ($row['status'] == "1") {
                                    $status = "Disetujui";
                                }else {
                                    $status = "Dibatalkan";
                                }
                                echo '<tr>';
                                echo '<td>'. $no++.'</td>';
                                echo '<td>'. $row['name'].'</td>';
                                echo '<td>'. $row['tgl_input'].'</td>';
                                echo '<td> '.$row['jml_barang'].'</td>';
                                echo '<td> '.$row['jml_qty'].'</td>';
                                echo '<td> '.$status.'</td>';
                                echo '<td><a type="button" class="btn-detail"
                                        href="detail_list_permintaan.php?&no_permintaan='.$row['no_permintaan'].'">
                        <span class="material-icons">
                            visibility
                        </span>
                        </a>
                        </td>';
                        echo '</tr> ';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->

<!--footer area-->
<?php include 'theme/footer.php'; }?>