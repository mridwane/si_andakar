<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
} else {
    include('../includes/connection.php');
    include 'theme/header.php';
    include 'theme/sidebar.php';

    $query = 'SELECT * ,concat(b.`c_fname`," ",b.`c_lname`)as name FROM tblrequestmitra a left join tblcustomer b on a.`c_id` = b.`c_id` WHERE a.`regis_no` = "' . $_GET['no_regis'] . '" ';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $no_regis = $row['regis_no'];
        $name = $row['name'];
        $tgl_input = $row['date_req'];
        $status = $row['status'];
        $no_telp = $row['C_PNUMBER'];
        $gender = $row['C_GENDER'];
        $alamat = $row['C_ADDRESS'];
        $email = $row['C_EMAILADD'];
        $kodepos = $row['ZIPCODE'];
        $umur = $row['C_AGE'];
        $user_id = $row['C_ID'];
    }
?>
    <style type="text/css">
        .error-msg {
            text-align: center;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Detail Permintaan Kemitraan</div>
            <div class="card-body">
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">No Registrasi: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $no_regis; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Status: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $status; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Nama Pelanggan: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $name; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Umur: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $umur; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Alamat: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $alamat; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Nomor Handphone: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $no_telp; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Jenis Kelamin: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $gender; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>

                    <td align="center" width="20%"><b style="font-size: 30px">Alamat Email: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $email; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td align="center" width="20%"><b style="font-size: 30px">Zipcode: </b></td>
                    <td align="center" width="20%">
                        <a style="font-size: 24px"><?php echo $kodepos; ?></a>
                    </td>
                </tr>
                <br>
                <br>
                <tr>


            </div>
        </div>
    </div>
    <?php if ($status == "unconfirmed") { ?>
        <div class="col-8">
            <button type="button" data-toggle="modal" data-target="#update_modal<?php echo $_GET['no_regis']; ?>">
                <span>Konfirmasi Permintaan</span>
            </button>
        </div>
    <?php
    } ?>


    <!--footer area-->
<?php include 'theme/footer.php';
    include 'controller/kemitraan_admin_controller.php';
} ?>