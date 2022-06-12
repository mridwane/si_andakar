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
             <a href="employeeadd.php" class="btn btn-info fas fa-plus"> Tambakan Karyawan</a>
            <div class="card-body">
              <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nomor</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th> 
                                        <th>Umur</th>
                                        <th>Posisi</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Perbaharui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php                  
                $query = 'SELECT * FROM tblemployee';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row['emp_id'].'</td>';
                            echo '<td>'. $row['fname']. ' '. $row['lname'].'</td>';                
                            echo '<td>'. $row['contact'].'</td>';
                            echo '<td>'. $row['email'].'</td>';  
                            echo '<td>'. $row['address'].'</td>';  
                            echo '<td>'. $row['gender'].'</td>';  
                            echo '<td>'. $row['age'].'</td>';
                            echo '<td>'. $row['position'].'</td>';
                            echo '<td>'. $row['hire_date'].'</td>';
                             echo '<td>  ';
                            echo ' <a  type="button" class="btn btn-lg btn-warning fas fa-user-tag" href="employeeupdate.php?action=view & id='.$row['emp_id'] . '"></a> ';

                            
                        
                            
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


