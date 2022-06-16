<?php $page = "daftar pesanan";?>
<?php include('includes/connection.php');?>

<!--header area-->
<?php include 'includes/header.php'; ?>

<!--sidebar area-->
<?php include 'includes/sidebar.php'; ?>
<?php 
$query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,delivery_date,C_PNUMBER,C_ADDRESS FROM tbltransacdetail a inner join tblcustomer b on a.`customer_id`=b.`C_ID`
              WHERE  transac_code ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
               $stat = $row['status'];
               $name = $row['name'];
               $del = $row['delivery_date'];
               $contact = $row['C_PNUMBER'];
               $address = $row['C_ADDRESS'];
               $cd = $row['transac_code'];
              }
         
?>
<div class="col-10">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <span id="divToPrint">
          <div class="card">
            <div class="card-header">
              <div style="margin-bottom: 30px">
                <center>
                  <h2>Purna Baja Harsco</h2>
                  <p style="font-size: 20px">Kota Cilegon</p>
                </center>
              </div>
              <?php if ($stat == 'Confirmed') {
                    ?>

              <ul>
                <div style="margin-bottom: 30px">
                  <h5>No Pemesanan : 0<?php echo $cd; ?></h5>
                  <h5>Nama : <?php echo $name; ?></h5>
                  <h5>Kontak : 0<?php echo $contact; ?></h5>
                  <h5>Alamat : <?php echo $address; ?></h5>
                  <h5>Tanggal Pengiriman : <?php echo $del; ?></h5>

                </div>
                <?php  }else{
                  ?>
                <h5>Pesanan anda sedang kami proses. Mohon menunggu petugas kami untuk mengkonfirmasi.</h5>
                <?php } ?>


                <div class="card-body">
                  <div class="table-responsive">
                    <table cellpadding="4" width="100%" cellspacing="0">
                      <thead align="left">
                        <tr>
                          <th>Produk</th>
                          <th>Tanggal Pengiriman</th>
                          <th>Banyak</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                  
                          $query = "SELECT b.product_name,a.date,a.qty FROM tbltransac a,tblproducts b WHERE a.product_code=b.product_code AND a.transac_code='".$_GET['id']."' GROUP BY a.product_code";
                          $result = mysqli_query($db, $query) or die (mysqli_error($db));                      
                            while ($row = mysqli_fetch_assoc($result)) {                                                
                                echo '<tr>';
                                echo '<td>'. $row['product_name'].'</td>';                     
                                echo '<td>'. $row['date'].'</td>';
                                echo '<td>'. $row['qty'].'</td>';
                              /* echo '<td>  ';
                                echo '<center> <a  type="button" class="btn btn-lg btn-info fas fa-cart-plus" href="addtransacdetail.php?action=edit & id='.$row['transac_id'] . '"></a> </td></center>';*/
                                echo '</tr> ';
                          }
                        ?>
                      </tbody>
                      <?php 
                        // $query = 'SELECT * FROM tbltransacdetail
                        //             WHERE
                        //             transac_code ='.$_GET['id'];
                        //           $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        //             while($row = mysqli_fetch_array($result))
                        //             {   
                        //             $zz = $row['totalprice'];
                        //             }
                              
                      ?>

                      <!-- <tr>
                        <td colspan="4" align="right"><br>
                          <h5> Subtotal :</h5>
                        </td>
                        <td><br>
                          <h5> Rp <?php echo $zz-150; ?></h5>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right">
                          <h5> Biaya Pengiriman :</h5>
                        </td>
                        <td>
                          <h5> Rp 10000</h5>
                        </td>

                      </tr>
                      <tr>
                        <td colspan="4" align="right">
                          <h5> Total :</h5>
                        </td>
                        <td>
                          <h5> Rp <?php echo $zz; ?></h5>
                        </td>
                      </tr> -->

                    </table>
                    <?php
                      $result = mysqli_query($db, "SELECT * FROM tbltransacdetail 
                      WHERE transac_code =".$_GET['id']) or die(mysqli_error($db));
                      while($row = mysqli_fetch_array($result))
                      {   
                      $stats = $row['status'];
                      }
            
                      if ($stats=='Confirmed') {
                    ?>
                    <h5>Dimohon untuk mencetak dan menyimpan bukti ini sebagai tanda pembelian</h5>
                    <p> Terima Kasih Telah Membeli! Semoga anda puas dengan pelayanan kami</p>

                    <p> Salam Hormat,</p>

                    <h4>Alycia Garden</h4>
                    <?php }else{ } ?>
                  </div>
                </div>
                <br>
              </ul>
              <button onclick="history.back()" class="btn btn-xs btn-info fas fa-arrow-left" ">Back</button>
              <?php 
                if ($stats=='Confirmed') {
              ?>
              <a href=" #" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>
                <?php } ?>
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
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>