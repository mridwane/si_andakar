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
  <input type="month" id="month" name="month" />
  <button type="submit" name="generate" class="btn btn-xs btn-info">Generate</button>

</form>
<hr>

<form action="" method="post">
  <button type="submit" class="btn btn-xs btn-info" name="week">Laporan Mingguan</button>

</form>

<hr>
<?php if (isset($_POST['generate'])==null) {
        echo "";
      }else{ ?>
<span id="divToPrint">
  <div class="card mb-3">
    <div class="card-header">
      <center>
        <h2>Laporan Penjualan</h2>
      </center>

      <div class="card-body">


        <div class="table-responsive">
          <p>Laporan untuk tahun/bulan: <?php 
                if (isset($_POST['generate'])) {
                    $monthyear = $_POST['month'];
                    echo $monthyear;
                }
              ?></p></br>
          <table cellpadding="4" width="100%" cellspacing="0" border="1">
            <thead>
              <tr align="center">
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Banyak</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Profit/Keuntungan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                                  if (isset($_POST['generate'])) {
                                    $monthyear = $_POST['month'];
                                    
                                    
                                    
                                    if(strcmp($monthyear,"")==0){
                                        echo "<script>
                                            alert('Silahkan masukan bulan dan tahun terlebih dahulu');
                                            window.location.href='reportpage.php?'
                                        </script>";
                                    }
                                    else{
                                        $monthyear = explode('-', $monthyear);
                                        $month=$monthyear[1];
                                        $year= $monthyear[0];
                                        $query = 'SELECT * FROM tbltransac a, tblproducts b WHERE a.`product_code`=b.`product_code` AND MONTH(`date`) = '.$month.' AND YEAR(`date`)= '.$year.'';
                                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                                        $totalqty = 0;
                                        $totalprofit = 0;
                  
                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    
                                        echo '<tr align="center">';
                                        echo '<td>'. $row['transac_code'].'</td>';                     
                                        echo '<td>'. $row['date'].'</td>';
                                        echo '<td>'. $row['product_name'].'</td>';
                                        
                                        echo '<td>'. $row['price'].'</td>';
                                        echo '<td>'. $row['total'].'</td>';
                                        echo '<td>'. $row['qty'].'</td>';
                                        $profit = $row['profit'];
                                        $qty = $row['qty'];
                                        $total = intval($profit) * intval($qty);
                                        $totalqty += $qty;
                                        $totalprofit += $profit;
                                        echo '<td>' . $total .'</td>';
                                    
                                
                                    
                                        echo '</tr > ';
                                    }
                                        echo  '<tr align="center" style="font-weight: bold">';
                                        echo  '<td colspan="5">Total Keseluruhan</td>';
                                        echo  '<td>'.$totalqty.'</td>';
                                        echo  '<td>'.$totalprofit.'</td>';
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
       
      }else{ ?>
<span id="divToPrint">
  <div class="card mb-3">
    <div class="card-header">
      <center>
        <h2>Laporan Penjualan</h2>
      </center>
      <div class="card-body">
        <div class="table-responsive">
          <p>Laporan Mingguan</p></br>
          <table cellpadding="4" width="100%" cellspacing="0" border="1">
            <thead>
              <tr align="center">
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Banyak</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Profit/Keuntungan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                      if (isset($_POST['week'])) {
                      
                            
                            $query = 'SELECT * FROM tbltransac a, tblproducts b WHERE a.`product_code`=b.`product_code` AND date > DATE_SUB(NOW(), INTERVAL 1 WEEK) ';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            $totalqty = 0;
                            $totalprofit = 0;
      
                        while ($row = mysqli_fetch_assoc($result)) {
                                        
                            echo '<tr align="center">';
                            echo '<td>'. $row['transac_code'].'</td>';                     
                            echo '<td>'. $row['date'].'</td>';
                            echo '<td>'. $row['product_name'].'</td>';
                            
                            echo '<td>'. $row['price'].'</td>';
                            echo '<td>'. $row['total'].'</td>';
                            echo '<td>'. $row['qty'].'</td>';
                            $profit = $row['profit'];
                            $qty = $row['qty'];
                            $total = intval($profit) * intval($qty);
                            $totalqty += $qty;
                            $totalprofit += $profit;
                            echo '<td>' . $total .'</td>';
                        
                    
                        
                            echo '</tr > ';
                        }
                            echo  '<tr align="center" style="font-weight: bold">';
                            echo  '<td colspan="5">Total Keseluruhan</td>';
                            echo  '<td>'.$totalqty.'</td>';
                            echo  '<td>'.$totalprofit.'</td>';
                            echo  '</tr>';

                          
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

<?php include 'theme/footer.php'; }?>
<?php include 'addtransac.php'; ?>
<script type="text/javascript">
  function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=800,height=800');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
  }
</script>