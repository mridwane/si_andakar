<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../../includes/connection.php');
    echo '<a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>';
    echo '<br></br>';
?>
    <?php
    $query = 'SELECT *,concat(`C_FNAME`," ",`C_LNAME`)as name,`C_PNUMBER` FROM `tbltransac` a INNER JOIN
     `tblcustomer` b on a.customer_id=b.C_ID INNER JOIN
     `tblalamat` c on b.C_ADRESSID=c.id_alamat WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $pajak = 0;
    $service = 0;
    $subtotal = 0;
    while ($row = mysqli_fetch_array($result)) {
        $stats = $row['status'];
        $tanggal_pemesanan = $row["date"];
        $tanggal_kirim = $row["reservation_date_time"];
        $name = $row['name'];
        $contact = $row['C_PNUMBER'];
        $address = $row['alamat'];
        $cd = $row['transac_code'];
        $service = $row["total_price"] * 0.05;
        $pajak = $row["total_price"] * 0.10;
        $subtotal = $row["total_price"];
    }

    $query2 = 'SELECT * FROM `tblbuktitransfer`  WHERE no_transac = "' . $_GET["no_transaksi"] . '" AND user="customer" AND status = "deny_adm_dp" OR status = "deny_adm_lns" ';
    $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
    $note_admin = "";
    while ($row2 = mysqli_fetch_array($result2)) {

        $note_admin = $row2["note"];
    }

    ?>

    <span id="divToPrint">
        <div class="card">
            <center>
                <h2>INVOICE CATERING</h2>
            </center>
            <div class="card-header">
                <div style="margin-bottom: 30px">
                    <h5>No Pesanan : <?php echo $cd; ?></h5>
                    <h5>Tanggal Pemesanan : <?php echo $tanggal_pemesanan; ?></h5>
                    <h5>Nama Pelanggan : <?php echo $name; ?></h5>
                    <h5>Telp : <?php echo $contact; ?></h5>
                    <h5>Alamat Tujuan : <?php echo $address; ?></h5>
                    <h5>Dikirimkan pada : <?php echo $tanggal_kirim; ?></h5>
                    <h5>Perihal : Pelunasan Pesanan Catering Sebesar Rp. <?php echo number_format(($subtotal + $pajak + $service)); ?></h5>
                </div>
                <div class="card-body">
                    <h4 style="color: blue">Informasi Pemesanan</h4>
                    <div class="table-responsive">
                        <table cellpadding="0" width="100%" cellspacing="0" border="1">
                            <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>Jumlah</th>
                                    <th>Harga Makanan</th>
                                    <th>Harga Saus</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 20px">
                                <?php
                                $query2 = 'SELECT * FROM `tbltransac` a INNER JOIN `tbltransacdetail` b on a.transac_code=b.transac_code JOIN `tblproducts` c on
                               b.product_code=c.product_id JOIN `tblsaus` d on b.kd_saus=d.id_saus WHERE a.transac_code ="' . $_GET['no_transaksi'] . '"';
                                $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));

                                while ($row2 = mysqli_fetch_assoc($result2)) {

                                    echo '<tr>';
                                    echo '<td>' . $row2['product_name'] .  "+" . $row2["nama_saus"] . '</td>';
                                    echo '<td>' . $row2['qty'] . '</td>';
                                    echo '<td>' . number_format($row2['price']) . '</td>';
                                    echo '<td>' . number_format($row2['harga_saus']) . '</td>';
                                    echo '<td>' . number_format(($row2['price'] + $row2['harga_saus']) * $row2['qty']) . '</td>';
                                    echo '<td>  ';
                                    /*echo '<center> <a  type="button" class="btn btn-lg btn-info fas fa-cart-plus" href="addtransacdetail.php?action=edit & id='.$row['transac_id'] . '"></a> </td></center>';*/
                                    echo '</tr> ';
                                }
                                ?>
                                <?php
                                $query = 'SELECT * FROM tbltransacdetail WHERE transac_code = "' . $_GET['no_transaksi'] . '"';
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    $total_price = $row['harga'];


                                ?>

                                    <tr>
                                        <td colspan="4" align="right">
                                            <h5> Subtotal :</h5>
                                        </td>
                                        <td>
                                            <h5> Rp. <?php echo number_format($subtotal); ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">
                                            <h5>Service Charge (5%) :</h5>
                                        </td>
                                        <td>
                                            <h5> Rp. <?php echo number_format($service); ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">
                                            <h5>Tax (10%) :</h5>
                                        </td>
                                        <td>
                                            <h5> Rp. <?php echo number_format($pajak); ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">
                                            <h5> Total Keseluruhan :</h5>
                                        </td>
                                        <td>
                                            <h5> Rp. <?php echo number_format(($subtotal + $pajak + $service)); ?></h5>
                                        </td>
                                    </tr>


                            </tbody>
                        </table>
                        <br>

                        <div style="margin-left:50%; display:inline;">
                            <p>Tanda Terima</p>
                            <br>
                            <br>
                            <p>(............................)</p>

                        </div>




                        <!-- /.container-fluid -->

                    <?php } ?>

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