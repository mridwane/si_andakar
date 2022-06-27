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
        <h3>Daftar Menu <a href="productadd.php" type="button" class="btn btn-info fas fa-plus"> Tambah Menu</a>
        </h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Menu</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Oleh</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                $query = 'SELECT *, concat(c.`fname`," ",c.`lname`)as name FROM tblproducts a inner join tblcategory b inner join tblusers c on a.`category_id` = b.`category_id`  and a.`user_id` = c.`user_id`';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $no++.'</td>';
                            echo '<td> '.$row['product_name'].'</td>';
                            echo '<td> '.$row['type'].'</td>';
                            echo '<td>'. $row['category'].'</td>';
                            echo '<td>'. $row['name'].'</td>';
                            echo '<td>'. $row['price'].'</td>';
                            if($row['status'] == "Tersedia") {
                                echo '<td><button class="btn btn-success">'. $row['status'].'</button></td>';
                            }else {
                                echo '<td><button class="btn btn-danger">'. $row['status'].'</button></td>';
                            }                            
                            echo '<td>
                                    <a title="Update Product" type="button" class="btn btn-warning" href="productupdate.php?action=view & id='.$row['product_id'] . '">
                                    <span class="material-icons">
                                       edit
                                    </span>                              
                                    </a>
                                    <a title="Update Product" type="button" class="btn btn-danger"
                                        href="productdelete.php?id='.$row['product_id'] . '">
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