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
        <h3>Permintaan Barang
        </h3>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">
                List Barang (<span class="total-count"></span>)
            </button>
            <button class="clear-cart btn btn-danger">Hapus List Barang</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                            $query = 'SELECT *,category,supplier_name,concat(d.`fname`," ",d.`lname`)as name FROM tblproducts a inner join tblcategory b inner join tblsupplier c inner join tblusers d on a.`category_id` = b.`category_id` and a.`supplier_id` = c.`supplier_id` and a.`user_id` = d.`user_id`';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>'. $row['product_id'].'</td>';
                                echo '<td> '.$row['product_name'].'</td>';
                                echo '<td><button class="add-to-cart btn btn-info" data-kode="'.$row['product_code'].'" data-name="'.$row['product_name'].'"
                                        >Tambah</button>
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

<!-- modal list permintaan barang -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Permintaan Barang</h5>
                <!-- <p>Nama : <?php echo $_SESSION['userid']." ".$_SESSION['lname'] ?></p> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="proses_permintaan.php" method="POST">
                <div class="modal-body">
                    <table class="show-cart table" id="show-table">
                    </table>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="total-produk" name="total_barang" id="total_barang" hidden>
                            <h5>Total Barang : <span class="total-produk"></span></h5>
                        </div>
                        <div class="col-6">
                            <input type="text" class="total-count" name="jml_total" id="jml_total" hidden>
                            <h5>Jumlah Total : <span class="total-count"></span></h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Kirim Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- /.container-fluid -->

<!--footer area-->
<?php include 'theme/footer.php'; }?>
<script src="js/custom-js/permintaan.js"></script>