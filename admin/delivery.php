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
              <h2>Pengiriman</h2>
            <div class="card-body">
              <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Pengiriman</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal pengiriman</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                        <th>Pilihan</th> 
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php                  
                $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name FROM tbltransacdetail a, tblcustomer b WHERE a.`customer_id`=b.`C_ID` AND a.status="Confirmed" and a.pay_met="COD"';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                          
                            echo '<tr>';
                            echo '<td><a title="View list Of Ordered" href="detailtransac.php?id='. $row['transac_code'].'" style="color: blue;font-size: 21px">'. $row['transac_code'].' </a></td>';                     
                            echo '<td>'. $row['name'].'</td>';
                            echo '<td>'. $row['date'].'</td>';
                            echo '<td>'. $row['delivery_date'].'</td>';
                            echo '<td>'. $row['totalprice'].'</td>';
                            echo '<td>'. $row['status'].'</td>';
                            echo '<td>';
                            echo '<a  type="button" class="btn-detail" href="detailtransac.php?id='.$row['transac_code'] . '"> 
                                    <span class="material-icons">
                                      visibility
                                    </span>  
                                  </a> ';
                             echo '<td class="bungkus-tombol">';
                            if ($row['status']=='Pending') {?>
                            <a title="Tolak" type="button" class="btn-cancel btn-danger" onclick="return confirm('Yakin ingin menolak transaksi?')" href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> ">
                              <span class="material-icons">
                              cancel
                              </span>
                            </a>
                            <a title="Konfirmasi" type="button" class="btn-confirm btn-primary" onclick="return confirm('Yakin ingin Mengkonfimasi Transaksi?')" href="confirm.php?action=edit & confirm=<?php echo $row['transac_code']; ?>">
                              <span class="material-icons">
                              check
                              </span>
                            </a>
                            <?php
                             }elseif ($row['status']=='Confirmed') {?>
                               <a title="Cancel" type="button" class="btn btn-xs btn-danger " onclick="return confirm('Yakin ingin menolak transaksi?')" href="confirm.php?action=edit & cancel=<?php echo $row['transac_code']; ?> ">Cancel</a>
                            
                             <?php 
                             }    

                             
                            echo '</td>';
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
<?php include 'addtransac.php'; ?>