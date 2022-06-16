<?php if (isset($_SESSION['C_ID']))?>
<?php include('includes/connection.php');?>
<?php $page = "Menu"; ?>
<!--header area-->
<?php include 'includes/header.php'; ?>


<body class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
            <img src="assets/images/hero-bg.jpg" alt="">
        </div>
        <!-- navigation strats -->
        <?php include 'includes/navigation.php'; ?>
        <!-- end navigation-->
    </div>
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h3><b>List Menu Kamu</b></h3>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody class="show-list">
                </tbody>
            </table>
        </div>
    </section>

    <!--footer area-->
    <?php include 'includes/footer.php'; ?>