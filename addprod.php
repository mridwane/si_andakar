<?php $page = "cart"; ?>
<?php include('includes/connection.php');?>

<!--header area-->
<?php include 'includes/header.php'; ?>

<!--sidebar area-->
<?php include 'includes/sidebar.php'; ?>

<?php if (!isset($_SESSION['cid'])) {
  echo "<script> location.replace('login.php'); </script>";
}else{ ?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <style>

  </style>
</head>

<body>
  <div class="col-10">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-8">
              <div class="detail-pemesan">
                <h2>Detail Pemesanan</h2>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Produk</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Banyak</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php            
                      $result = mysqli_query($db, 'SELECT current_date FROM tblusers') or die(mysqli_error($db));
                      while($row = mysqli_fetch_array($result))
                      {   
                        $date = $row['current_date'];
                      } ?>
                        <?php 
                      if (!empty($_SESSION["cart"])) {
                        $_SESSION['mm']=0;
                        foreach($_SESSION["cart"] as $keys => $values){
                          ?>
                        <tr>
                          <td><?php echo $values["name"]; ?></td>
                          <td><?php echo $date; ?></td>
                          <td><?php echo $values["quantity"]; ?></td>
                          </td>
                        </tr>
                        <?php 
                      // $name= $values["name"];  
                      // $_SESSION['mm'] = $_SESSION['mm'] + $potprice + ($values["quantity"] * $values["price"]);
                    }
                    ?>
                      </tbody>
                      <?php } ?>
                    </table>
                  </div>

                </div>


              </div>
            </div>
            <div class="col-lg-4">
              <div class="ringkasan">
                <div class="container">
                  <form role="form" method="post" action="transactionsave.php?action=adds">
                    <h2>Informasi Pengiriman</h2>

                    <h5><span class="material-icons" style="padding-right:10px;">person</span>
                      <?php echo $_SESSION['C_FNAME'] ?> <?php echo $_SESSION['C_LNAME'] ?></h5><br>
                    <h5><span class="material-icons" style="padding-right:10px;">place</span>
                      <?php echo $_SESSION['address'] ?></h5><br>
                    <h5><span class="material-icons" style="padding-right:10px;">call</span>
                      0<?php echo $_SESSION['contact'] ?></h5><br>
                    <h5><span class="material-icons" style="padding-right:10px;">email</span>
                      <?php echo $_SESSION['email'] ?></h5><br>
                    <h5><span class="material-icons" style="padding-right:10px;">date_range</span>
                      <p id="tanggal">Tanggal Pengiriman :</p></br>
                    </h5>
                    <input type="date" onchange="validate()" name="del" id="date" style="width: 206px" required>
                    <tr> <br><br>
                      <!-- <td>Metode Pembayaran</td>
                  <td> -->
                      <!-- <input type="text" id="date"> -->
                      <!-- <input type="button" id="btn"  value="Show"/> -->
                      <!-- <select onchange="bayar();" class="form-control" id="paymethod" name="paymethod">
                      <option value="COD">Bayar saat barang sampai </option>
                      <option value="Bayar_di_tempat">Bayar di tempat</option>
                    </select>
                    <input type="hidden" placeholder="HH-MM-AM/PM" id="ftime" name="ftime"
                      value="<?php echo date('y-m-d h:i:s') ?>" class="form-control" />
                    <br>
                    <br>
                    <h2>Ringkasan Pemesanan</h2>
                    <div class="row">
                      <div class="col-lg-7">
                        <h5>Subtotal</h5><br>
                      </div>
                      <div class="col-lg-4">
                        <h5>Rp <?php echo $_SESSION['mm']; ?></h5><br>
                      </div>
                      <div class="col-lg-7">
                        <h5>Biaya Pengiriman </h5><br>
                      </div>
                      <div class="col-lg-4">
                        <h5 id="biaya">Rp 10000</h5><br>
                      </div>
                      <div class="col-lg-7">
                        <h5>Total</h5><br>
                      </div>
                      <div class="col-lg-4">
                        <h5 id="total">Rp <?php echo $_SESSION['mm']+10000; ?></h5><br>
                      </div>
                    </div> -->
                      <center><button type=submit id="submit" onclick="return confirm('Konfirmasi Pemesanan?')"
                          class="btn tombol" style="color: black;">Masukan Pemesanan</button></center>

                      <!-- <div class="form-group">
                                        <input class="form-control" placeholder="Supplier Name" name="supplier" required autofocus="autofocus">
                                      </div>
                                      <div class="form-group">
                                        <input class="form-control" type="number" placeholder="Contact" name="contact"required>
                                      </div> 
                                      <div class="form-group">
                                        <input class="form-control" placeholder="Email" name="email"required>
                                      </div> 
                                      <div class="form-group">
                                        <input class="form-control" placeholder="Address" name="address"required>
                                      </div> 
                                      
                                      <button type="submit" class="btn btn-default">Save Record</button>
                                      <button type="reset" class="btn btn-default">Clear Entry</button> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function validate() {
      var x = document.getElementById("date").value;
      var today = new Date();

      month = '' + (today.getMonth() + 1),
        day = '' + today.getDate(),
        year = today.getFullYear();

      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;

      var date = year + '-' + month + '-' + day;
      var datenow = new Date(date);
      var datepick = new Date(x);
      if (datepick.getTime() < datenow.getTime()) {
        alert("Tanggal Pengiriman yang anda pilih tidak valid\nAnda tidak dapat memilih tanggal sebelum hari ini");
        document.getElementById("submit").disabled = true;
      } else {
        document.getElementById("submit").disabled = false;
      }

    }

    function bayar() {
      var x = document.getElementById("paymethod").value;
      if (x == "Bayar_di_tempat") {
        document.getElementById("tanggal").innerHTML = "Tanggal Pengambilan : ";
        document.getElementById("biaya").innerHTML = "Rp. 0";
        document.getElementById("total").innerHTML = < ? php echo $_SESSION['mm']; ? > ;
      } else if (x == "COD") {
        document.getElementById("tanggal").innerHTML = "Tanggal Pengiriman : ";
        document.getElementById("total").innerHTML = < ? php echo $_SESSION['mm'] + 10000; ? > ;
        document.getElementById("biaya").innerHTML = "Rp. 10000";
      }
    }
  </script>
</body>

</html>









<?php include 'includes/footer.php'; }?>