<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';
?> 
      <form action="" method="post">
            <label for="month" id="idmonth">Bulan</label>
            <input type="month" id="month" name="month"/>
            <button type="submit" name="generate" class="btn btn-xs btn-info">Generate</button>
            
      </form>
      <hr>
      <form action="" method="post">
            <button type="submit" class="btn btn-xs btn-info" name="week">Laporan Mingguan</button>
            
      </form>
      <br>
      <?php if (isset($_POST['generate'])==null) {
        echo "";
      }else{ ?>
        <span id="divToPrint">
          <div class="card mb-3">
            <div class="card-header">
              <center><h2>Laporan Penyetokan</h2></center>
        
            <div class="card-body">
                
                
              <div class="table-responsive">
              <p>Laporan penyetokan untuk tahun/bulan: <?php 
                if (isset($_POST['generate'])) {
                    $monthyear = $_POST['month'];
                    echo $monthyear;
                }
              ?></p></br>
                            <table cellpadding="4" width="100%" cellspacing="0" border="1">
                                <thead >
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal Penyetokan</th>
                                        <th>Oleh</th>
                                        <th>Penambahan stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if (isset($_POST['generate'])) {
                                    $monthyear = $_POST['month'];
                                    
                                    
                                    
                                    if(strcmp($monthyear,"")==0){
                                        echo "<script>
                                            alert('Silahkan masukan bulan dan tahun terlebih dahulu');
                                            window.location.href='reportstock.php?'
                                        </script>";
                                    }
                                    else{
                                        $monthyear = explode('-', $monthyear);
                                    $month=$monthyear[1];
                                    $year= $monthyear[0];
                                    $query = 'SELECT * FROM tblstockhistory a, tblproducts b, tblusers c WHERE a.`product_code`=b.`product_code` AND  a.`user_id`=c.`user_id` AND MONTH(`date`) = '.$month.' AND YEAR(`date`)= '.$year.'';
                                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                                    $no = 0;
                                    $total = 0;
                  
                                    while ($row = mysqli_fetch_assoc($result)) {
                                         $no = $no+1;           
                                        echo '<tr align="center">';
                                        echo '<td>'. $no.'</td>';                     
                                        echo '<td>'. $row['product_name'].'</td>';
                                        echo '<td>'. $row['date'].'</td>';
                                        
                                        echo '<td>'. $row['fname']." ".$row['lname'].'</td>';
                                        echo '<td>'. $row['qty'].'</td>';
                                        
                                        $total += $row['qty'];
                                    
                                        echo '</tr > ';
                                    }
                                        echo  '<tr align="center" style="font-weight: bold">';
                                        echo  '<td colspan="4">Total Keseluruhan</td>';
                                        echo  '<td>'.$total.'</td>';
                                        echo  '</tr>';

                                      
                                    }
                                    
                                }                  
                
                
                                ?> 
                               
                                    
                                </tbody>
                            </table>
                        </div>
            </div>
           
          </div>

          
        </div>
        </span>
        <!-- /.container-fluid -->
        <a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>
        <?php } ?>

        <?php if (isset($_POST['week'])==null) {
        echo "";
      }else{ ?>
        <span id="divToPrint">
          <div class="card mb-3">
            <div class="card-header">
              <center><h2>Laporan Penyetokan</h2></center>
        
            <div class="card-body">
                
                
              <div class="table-responsive">
              <p>Laporan penyetokan mingguan: <?php 
                if (isset($_POST['week'])) {
                }
              ?></p></br>
                            <table cellpadding="4" width="100%" cellspacing="0" border="1">
                                <thead >
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal Penyetokan</th>
                                        <th>Oleh</th>
                                        <th>Penambahan stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  
                                    $query = 'SELECT * FROM tblstockhistory a, tblproducts b, tblusers c WHERE a.`product_code`=b.`product_code` AND  a.`user_id`=c.`user_id` AND date > DATE_SUB(NOW(), INTERVAL 1 WEEK)';
                                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                                    $no = 0;
                                    $total = 0;
                  
                                    while ($row = mysqli_fetch_assoc($result)) {
                                         $no = $no+1;           
                                        echo '<tr align="center">';
                                        echo '<td>'. $no.'</td>';                     
                                        echo '<td>'. $row['product_name'].'</td>';
                                        echo '<td>'. $row['date'].'</td>';
                                        
                                        echo '<td>'. $row['fname']." ".$row['lname'].'</td>';
                                        echo '<td>'. $row['qty'].'</td>';
                                        
                                        $total += $row['qty'];
                                    
                                        echo '</tr > ';
                                    }
                                        echo  '<tr align="center" style="font-weight: bold">';
                                        echo  '<td colspan="4">Total Keseluruhan</td>';
                                        echo  '<td>'.$total.'</td>';
                                        echo  '</tr>';

                                      
                              
                                    
                                                  
                
                
                                ?> 
                               
                                    
                                </tbody>
                            </table>
                        </div>
            </div>
           
          </div>

          
        </div>
        </span>
        <!-- /.container-fluid -->
        <a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>
        <?php } ?>


        

<?php include 'theme/footer.php'; }?>
<?php include 'addtransac.php'; ?>
<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=800,height=800');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML +'</html>');
        popupWin.document.close();
            }
 </script>