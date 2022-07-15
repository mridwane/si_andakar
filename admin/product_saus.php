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
        <h3>Daftar Menu <a href="product_saus_add.php" type="button" class="btn btn-info fas fa-plus"> Tambah Saus</a>
        </h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Saus</th>
                            <th>Oleh</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                $query = 'SELECT *, concat(b.`fname`," ",b.`lname`)as name FROM tblsaus a inner join tblusers b ON a.`user_id` = b.`user_id` WHERE NOT id_saus ="S100"';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $no++.'</td>';
                            echo '<td> '.$row['nama_saus'].'</td>';
                            echo '<td>'. $row['name'].'</td>';
                            echo '<td>'. $row['harga_saus'].'</td>';
                            if($row['stok_saus'] == "Tersedia") {
                                echo '<td><button class="btn btn-success">'. $row['stok_saus'].'</button></td>';
                            }else {
                                echo '<td><button class="btn btn-danger">'. $row['stok_saus'].'</button></td>';
                            }                            
                            echo '<td>
                                    <a title="Update Product" type="button" class="btn btn-warning" href="product_saus_update.php?action=view&id='.$row['id_saus'] . '">
                                    <span class="material-icons">
                                       edit
                                    </span>                              
                                    </a>
                                    <a title="Update Product" type="button" class="btn btn-danger"
                                        href="product_saus_delete.php?id='.$row['id_saus'] . '">
                                        <span class="material-icons">
                                            delete
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