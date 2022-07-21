<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../includes/connection.php');
    include 'theme/header.php';
    include 'theme/sidebar.php';

    $query = 'SELECT * ,concat(b.`c_fname`," ",b.`c_lname`)as name FROM tblrequestmitra a left join tblcustomer b on a.`c_id` = b.`c_id` left join tblalamat c on b.`C_ADRESSID` = c.`id_alamat` WHERE a.`regis_no` = "' . $_GET['no_regis'] . '"';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $no_regis = $row['regis_no'];
        $name = $row['name'];
        $tgl_input = $row['date_req'];
        $status = $row['status'];
        $no_telp = $row['C_PNUMBER'];
        $gender = $row['C_GENDER'];
        $alamat = $row['alamat'];
        $email = $row['C_EMAILADD'];
        $kodepos = $row['ZIPCODE'];
        $umur = $row['C_AGE'];
        $user_id = $row['C_ID'];
        $id_alamat = $row['C_ADRESSID'];
    }
?>
<style type="text/css">
    .error-msg {
        text-align: center;
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card mx-auto mt-5">
                <div class="card-header">Detail Permintaan Kemitraan</div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>No Registrasi:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $no_regis; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Status:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $status; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Nama Pelanggan:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $name; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Umur:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $umur; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Alamat:</b></span>
                        </div>
                        <?php if($id_alamat == 0){ ?>
                        <textarea name="" id="" cols="53" rows="4" readonly>Alamat belum di setting</textarea>
                        <?php }else {?>
                        <textarea name="" id="" cols="53" rows="4" readonly><?php echo $alamat; ?></textarea>
                        <?php } ?>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Nomor Handphone:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $no_telp; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Jenis Kelamin:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $gender; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Alamat Email:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $email; ?>" readonly>
                    </div>
                    <?php if ($status == "active" || $status == "nonactive") { ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><b>Status Mitra:</b></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $status; ?>" readonly>
                    </div>
                    <?php  } ?>

                    <?php if ($status == "unconfirmed" || $status == "interview") { ?>
                    <div class="col-8">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#update_modal<?php echo $_GET['no_regis']; ?>">
                            <span>Konfirmasi Permintaan</span>
                        </button>
                    </div>
                    <?php  } ?>
                    <?php if ($status == "active") { ?>
                    <div class="col-8">
                        <a href="controller/kemitraan_status.php?no_regis=<?php echo $_GET['no_regis']; ?>&action=nonactive"
                            type="button" class="btn btn-danger">
                            <span>Nonaktifkan Mitra</span>
                        </a>
                    </div>
                    <?php  } else{ ?>
                    <div class="col-8">
                        <a href="controller/kemitraan_status.php?no_regis=<?php echo $_GET['no_regis']; ?>&action=active"
                            type="button" class="btn btn-success">
                            <span>Aktifkan Mitran</span>
                        </a>
                    </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <img src="images/detail_kemitraan.svg" alt="">
        </div>
    </div>
</div>
<br>


<!--footer area-->
<?php include 'theme/footer.php';
    include 'controller/kemitraan_admin_controller.php';
} ?>