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
              <th>No</th>
              <th>Nama Pelanggan</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php                  
                $query = 'SELECT * FROM tblcustomer a INNER JOIN tblalamat b ON a.C_ADRESSID=b.id_alamat';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                                             

                            echo '<tr>';
                            echo '<td>'. $no++.'</td>';
                            echo '<td>'. $row['C_FNAME']. ' '. $row['C_LNAME'].'</td>';
                            echo '<td>  ';
                            echo '<a  type="button" class="btn-detail" data-toggle="modal" data-target="#modal'.$row['C_ID'] . '">
                                    <span class="material-icons">
                                      visibility
                                    </span>
                                  </a> ';

                           
                            echo '</tr> ';

                             echo '
                             <div class="modal fade" id="modal'.$row['C_ID'] . '" data-backdrop="static"
                               data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                               aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                     <h5 class="modal-title" id="staticBackdropLabel">Detail Profil</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                     </button>
                                   </div>
                                   <div class="modal-body">
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Nama</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['C_FNAME']. ' '. $row['C_LNAME'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Email</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['C_EMAILADD'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Username</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['username'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Umur</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['C_AGE'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">No HP</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['C_PNUMBER'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Jenis Kelamin</span>
                                       </div>
                                       <input type="text" class="form-control" id="basic-url"
                                         aria-describedby="basic-addon3" value="'. $row['C_GENDER'].'">
                                     </div>
                                     <div class="input-group mb-3">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon3">Jenis Kelamin</span>
                                       </div>
                                       <textarea class="form-control" rows="4" cols="50">
                                       '.$row['alamat'].'
                                       </textarea>
                                     </div>
                                   </div>
                                   <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   </div>
                                 </div>
                               </div>
                             </div>';
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