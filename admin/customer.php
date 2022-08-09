<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';
?>

<div class="card mb-3">
  <div class="card-header">
    <h2>Pelanggan </h2>
    <!--    <a href="#" data-toggle="modal" data-target="#logoutModal5" class="btn btn-lg btn-info fas fa-plus"> Add New</a>  -->
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Pelanggan</th>
              <th>Umur</th>
              <th>Alamat</th>
              <th>Nomor Kontak</th>
              <th>Jenis Kelamin</th>
              <th>Alamat Email</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php                  
                    $query = 'SELECT * FROM tblcustomer a INNER JOIN tblalamat b ON a.C_ADRESSID = b.id_alamat';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             

                            echo '<tr>';
                            echo '<td>'. $row['C_ID'].'</td>';
                                echo '<td>'. $row['C_FNAME']. ', '. $row['C_LNAME'].'</td>';
                           // echo '<td>'. .'</td>';                  
                            echo '<td>'. $row['C_AGE'].'</td>';
                            if($row['C_ADRESSID'] == 0){
                              echo '<td>Alamat Belum ada</td>';
                            }
                            else{
                              echo '<td>'. $row['alamat'].'</td>';
                            }                            
                            echo '<td>'. $row['C_PNUMBER'].'</td>';  
                            echo '<td>'. $row['C_GENDER'].'</td>';  
                            echo '<td>'. $row['C_EMAILADD'].'</td>';
                            echo '<td>  ';
                            echo '<a  type="button" class="btn-detail" href="customerdetail.php?action=view & id='.$row['C_ID'] . '">
                                    <span class="material-icons">
                                      visibility
                                    </span>
                                  </a> ';

                           
                            echo '</tr> ';
                }
            ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>


</div>
<!-- /.container-fluid -->

<?php include 'theme/footer.php'; }?>