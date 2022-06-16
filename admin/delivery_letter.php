<?php
session_start();
if(!isset($_SESSION["userid"])){
 header("Location: login.php");
}else{
include('../includes/connection.php');
include 'theme/header.php';
include 'theme/sidebar.php';
echo '<a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>';
echo '<br></br>';
?>
<?php
      $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER`,`C_ADDRESS` FROM `tbltransacdetail` a INNER JOIN `tblcustomer` b on a.`customer_id`=b.`C_ID`
              WHERE transac_code ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
               $stats = $row['status'];
               $name = $row['name'];
               $contact = $row['C_PNUMBER'];
               $address = $row['C_ADDRESS'];
               $cd = $row['transac_code'];
              }
         
?>

<span id="divToPrint">
  <div class="card">
    <center>
      <h2>SURAT JALAN</h2>
    </center>
    <div class="card-header">
      <div style="margin-bottom: 30px">
        <h5>Surat Jalan No : 0<?php echo $cd; ?></h5>
        <h5>Pelanggan : <?php echo $name; ?></h5>
        <h5>Kontak : 0<?php echo $contact; ?></h5>
        <h5>Alamat : <?php echo $address; ?></h5>
      </div>
      <div class="card-body">
        <h4 style="color: blue">Informasi Pemesanan</h4>
        <div class="table-responsive">
          <table cellpadding="0" width="100%" cellspacing="0" border="1">
            <thead>
              <tr>
                <th>Produkt</th>
                <th>Tanggal Pesanan</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody style="font-size: 20px">
              <?php                  
                $query2 = "SELECT b.product_name,a.date,a.qty FROM tbltransac a,tblproducts b WHERE a.product_code=b.product_code AND a.transac_code='".$_GET['id']."' GROUP BY a.product_code";
                    $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
                  
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row2['product_name'].'</td>';                     
                            echo '<td>'. $row2['date'].'</td>';
                            echo '<td>'. $row2['qty'].'</td>';
                           echo '<td>  ';
                            /*echo '<center> <a  type="button" class="btn btn-lg btn-info fas fa-cart-plus" href="addtransacdetail.php?action=edit & id='.$row['transac_id'] . '"></a> </td></center>';*/
                            echo '</tr> ';
                }
            ?>
              <?php 
                $query = 'SELECT * FROM tbltransacdetail
              WHERE
              transac_code ='.$_GET['id'];
              $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
              //  $zz = $row['totalprice'];
              ?>

              <!-- <tr>
                <td colspan="5" align="right"><br>
                  <h5> Subtotal :</h5>
                </td>
                <td><br>
                  <h5> Rp. <?php echo $zz-10000; ?></h5>
                </td>
              </tr>
              <tr>
                <td colspan="5" align="right">
                  <h5> Biaya pengiriman :</h5>
                </td>
                <td>
                  <h5> Rp. 10000</h5>
                </td>
              </tr>
              <tr>
                <td colspan="5" align="right">
                  <h5> Total :</h5>
                </td>
                <td>
                  <h5> Rp. <?php echo $zz; ?></h5>
                </td>
              </tr> -->


            </tbody>
          </table>
          <br>
          <p>Kami kirimkan Barang diatas dengan kendaran...............................................................,
            No Kendaran................................................................</p>
          <div style="margin-left:50%; display:inline;">
            <p>Tanda Terima</p>
            <br>
            <br>
            <p>(............................)</p>

          </div>




          <!-- /.container-fluid -->

          <?php } ?>

          <?php }?>
</span>


<script type="text/javascript">
  function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=800,height=800');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
  }
</script>