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
    <a href="useradd.php" type="button" class="btn btn-info fas fa-plus">Tambah Pengguna</a>
    <div class="card-body">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Lihat Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php                  
                $query = 'SELECT * FROM tblusers';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $no++.'</td>';
                            echo '<td>'. $row['fname'].' '. $row['lname'].'</td>';
                            echo '<td>'. $row['position'].'</td>';
                            echo '<td class="bungkus-tombol">  ';
                            echo '<button  type="button" class="btn-detail" data-toggle="modal" data-target="#modal'.$row['user_id'] . '">
                                    <span class="material-icons">
                                      visibility
                                    </span>
                                  </button> ';


                            
                            echo '</tr> ';

                            echo '
                            <div class="modal fade" id="modal'.$row['user_id'] . '" data-backdrop="static" data-keyboard="false"
                              tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <span class="input-group-text"
                                          id="basic-addon3">Nama</span>
                                      </div>
                                      <input type="text" class="form-control" id="basic-url"
                                       aria-describedby="basic-addon3" value="'. $row['fname'].' '. $row['lname'].'">
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Email</span>
                                      </div>
                                      <input type="text" class="form-control" id="basic-url"
                                        aria-describedby="basic-addon3" value="'. $row['email'].'">
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Posisi</span>
                                      </div>
                                      <input type="text" class="form-control" id="basic-url"
                                        aria-describedby="basic-addon3" value="'. $row['position'].'">
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Username</span>
                                      </div>
                                      <input type="text" class="form-control" id="basic-url"
                                        aria-describedby="basic-addon3" value="'. $row['username'].'">
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
</div>
<!-- /.container-fluid -->

<!--footer area-->
<?php include 'theme/footer.php'; }?>
