<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
include 'includes/header.php';
include_once 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_SESSION['login'])) {
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
} elseif (isset($_SESSION['google_login'])) {
    $username = $_SESSION['nama'];
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: login.php");
    exit;
}
?>
<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php include 'includes/navbar.php'; ?>

        <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-2 bread">Edit Order</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="profile.php">Profile </a><i class="ion-ios-arrow-forward"></i></span><span class="mr-2"><a href="myorder.php"><span>My Order </a><i class="ion-ios-arrow-forward"></i></span><span>My Order Info</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Menu Section -->
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-2">
                    <div class="col-md-7 text-center heading-section ftco-animate">
                        <span class="subheading">Gakedai</span>
                        <h2 class="mb-4">Edit Order</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card-body">
                            <?php $ambil1 = $conn->query("SELECT * FROM daftar_order JOIN account_google ON daftar_order.id_pelanggan = account_google.id WHERE daftar_order.id_order='$_GET[id]'");
                            $detail = $ambil1->fetch_assoc(); ?>
                            <div class='col-md-6'>
                                <h5>Nama Pesanan : <?php echo $detail['nama']; ?></h5>
                            </div>
                            <div class='col-md-6'>
                                <h5>No Telepon : <?php echo $detail['no_telepon']; ?></h5>
                            </div>
                            <div class='col-md-12'>
                                <h5>Alamat : <?php echo $detail['alamat']; ?></h5>
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">SubHarga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $iter = 1; ?>
                                    <?php $totalbelanja = 0; ?>
                                    <?php $ambil = $conn->query("SELECT * FROM pembelian_produk JOIN tblmenu ON pembelian_produk.id_produk = tblmenu.id WHERE pembelian_produk.id_order='$_GET[id]'"); ?>
                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                        <tr>
                                            <th><?php echo $iter; ?></th>
                                            <th><?php echo $pecah['nama_produk']; ?></th>
                                            <td>Rp.<?php echo number_format($pecah['harga']); ?></td>
                                            <td><?php echo $pecah['jumlah']; ?></td>
                                            <?php $subharga = $pecah['harga'] * $pecah['jumlah']; ?>
                                            <td>Rp.<?php echo number_format($subharga); ?></td>
                                        </tr>
                                        <?php $iter += 1; ?>

                                        <?php $totalbelanja += $subharga; ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4"> Sub Total</th>
                                        <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"> Ongkir</th>
                                        <th>Rp.<?php echo number_format($detail['tarif']); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <h3>Total Pembayaran : <?php echo number_format($detail['total_order']); ?></h3>
                            <h3>Bukti Pembayaran : <?php echo number_format($detail['total_order']); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include 'includes/footer.php';
        ?>