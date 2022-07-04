<?php
include('../includes/connection.php');
session_start();
if(!isset($_SESSION["cid"])){
header("Location: login.php");
}else{
include('../includes/connection.php');
// if (isset($_SESSION['C_ID']))
}
// var_dump($kd_menu);
$cid = $_SESSION['cid'];
$jenis = $_POST['jenis'];
$kd_cart = $jenis.$cid;?>


<div class="modal-body show-cart">
    <table class="table">
        <?php 
    $query = mysqli_query($db, 'SELECT * FROM tblcartdetail a JOIN tblcart b ON a.kd_cart = b.kd_cart JOIN tblproducts c ON
    a.kd_menu = c.product_id JOIN tblsaus d ON
    a.kd_saus = d.id_saus WHERE a.kd_cart = "'.$kd_cart.'"');
    while($row = mysqli_fetch_array($query)){
        $total = $row['total'];
    ?>
        <tr>
            <input type="text" name="product_code[]" id="product_code" style="display:none"
                value="<?= $row['kd_menu']?>">
            <input type="text" name="qty[]" id="qty" style="display:none" value="<?= $row['qty']?>">
            <?php if($row['nama_saus'] == "Tanpa Saus") {?>
            <td><?= $row['product_name']?></td>
            <?php }else{?>
            <td><?= $row['product_name']?> + <?= $row['nama_saus'] ?></td>
            <?php } ?>
            <td><?= $row['qty']?></td>
            <td>Rp. <?= number_format($row['harga'] ,0,',','.') ?></td>
            <td><a href="#" class="btn btn-danger delete-item" data-id-cart="<?= $row['id']?>">Hapus</a></td>
        </tr>

        <?php } ?>
    </table>
    <?php if(empty($total)){?>
    <div>Total price: Rp. <span class="priceTotal" data-price="<?= $total; ?>" data-jenis="<?= $jenis; ?>"> </span>
    </div>
    <?php }else { ?>
    <div>Total price: Rp. <span class="priceTotal" data-price="<?= $total; ?>"
            data-jenis="<?= $jenis; ?>"><?= number_format($total ,0,',','.') ?>
        </span>
    </div>
    <?php } ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <!-- <button type="submit" class="btn btn-primary nextOrder disabled">Minimal Order 5.000.000</button> -->
    <button type="submit" class="btn btn-primary nextOrder disabled">Checkout</button>
</div>


<script>
    $(document).ready(function () {
        loadCheckout();

        function loadCheckout() {
            let total = $('.priceTotal').data('price');
            let jenis = $('.priceTotal').data('jenis');
            console.log(jenis);
            if (jenis == 'Catering') {
                if (total <= 5000000) {
                    $('.nextOrder').addClass('disabled');
                    $('.nextOrder').text('Minimal Order 5.000.000');
                } else {
                    $('.nextOrder').removeClass('disabled');
                    $('.nextOrder').text('Checkout');
                }
            } else {
                if (total > 0) {
                    $('.nextOrder').removeClass('disabled');
                } else {
                    $('.nextOrder').addClass('disabled');
                }
            }

        }
    })
</script>