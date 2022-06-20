<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../includes/connection.php');
    include 'theme/header.php';
    include 'theme/sidebar.php';
?>
    <!-- Product Tables -->
    <div class="card mb-3">
        <div class="card-header">
            <h3>List Permintaan Menjadi Mitra
            </h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Register</th>
                                <th>Atas Nama</th>
                                <th>Tanggal Input</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = 'SELECT * ,concat(b.`c_fname`," ",b.`c_lname`)as name FROM tblrequestmitra a inner join tblcustomer b on a.`c_id` = b.`c_id`';
                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            // membuat nomer otomatis untuk di tabel
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                // cek Status Pending atau disetujui
                                if ($row['status'] == "0") {
                                    $status = "Pending";
                                } elseif ($row['status'] == "1") {
                                    $status = "Disetujui";
                                } else {
                                    $status = "Dibatalkan";
                                }
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $row['regis_no'] . '</td>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td> ' . $row['date_req'] . '</td>';
                                echo '<td> <a href="controller/download_file_kemitraan.php?file_name=' . $row['file'] . '&no_regis=' . $row['regis_no'] . '">' . $row['file'] . '</a></td>';
                                echo '<td> ' . $row['status'] . '</td>';
                                echo '<td><a type="button" class="btn-detail"
                                        href="detail_list_kemitraan.php?&no_regis=' . $row['regis_no'] . '">
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
<?php include 'theme/footer.php';
} ?>