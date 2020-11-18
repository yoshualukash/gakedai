<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
include 'includes/header.php';
include_once 'config.php';
if (!isset($_GET['id'])) {
    header("Location: menu.php");
    exit;
}
$id = $_GET['id'];
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
if (isset($_POST["submit"])) {
    if (add_buktibayar($_POST) > 0) {
        echo "<script>
            alert('Bukti bayar telah ditambahkan!');
            document.location.href = 'myorder.php';
			</script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<style>
    .alert-custom {
        background-color: #FAE5D3;
        color: #CA6F1E;
    }
</style>
<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php if (isset($username)) : ?>
            <li class="nav-item active submenu dropdown">
                <a class="nav-link">My Account</a>
                <ul class='dropdown-menu'>
                    <li class='nav-item'><a href='profile.php' class='nav-link'><span style="color:red">Profile</span></a>
                    <li class='nav-item'><a href='myorder.php' class='nav-link'><span style="color:red">My Order</span></a>
                    <li class='nav-item'><a href='myhistoryorder.php' class='nav-link'><span style="color:red">History Order</span></a>
                    <li class='nav-item'><a href='logout.php' class='nav-link'><span style="color:red">Logout</span></a>
                </ul>
            </li>
        <?php else : ?>
            <li class="nav-item"><a href="login.php" class="nav-link">Login / Register</a></li>
        <?php endif; ?>

    </ul>
</div>
</div>
</nav>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">Nota Transaksi</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="profile.php">Profile <i class="ion-ios-arrow-forward"></i></a></span><span>Nota <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<?php $ambil1 = $conn->query("SELECT * FROM daftar_order JOIN account_google ON daftar_order.id_pelanggan = account_google.id WHERE daftar_order.id_order='$_GET[id]'");
$detail = $ambil1->fetch_assoc(); ?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Gakedai</span>
                <h2 class="mb-4">Nota Pembayaran</h2>
            </div>
        </div>
        <div class="menus ftco-animate">
            <div class="row">
                <div class="col-md-6">
                    <b>Status Pembayaran :</b>
                    <?php if ($detail['status_pesan'] == 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <b><i class="fas fa-times fa-2x fa-pull-right"></i>Belum Lunas</b>
                        </div>
                    <?php elseif ($detail['status_pesan'] == 1) : ?>
                        <div class="alert alert-secondary">
                            <b><i class="fa fa-spinner fa-2x fa-pull-right fa-spin"></i>Bukti bayar sedang dicek</b>
                        </div>
                    <?php elseif ($detail['status_pesan'] == 2) : ?>
                        <div class="alert alert-success" role="alert">
                            <b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Sudah Lunas</b>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <b>Status Order :</b>
                    <?php if ($detail['status_tracking'] == 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <b><i class="fas fa-times fa-2x fa-pull-right"></i>Pesanan Belum Dibuat</b>
                        </div>
                    <?php elseif ($detail['status_tracking'] == 1) : ?>
                        <div class="alert alert-custom">
                            <b><i class="fas fa-lightbulb fa-2x fa-pull-right"></i>Pesanan Sedang Dibuat</b>
                        </div>
                    <?php elseif ($detail['status_tracking'] == 2) : ?>
                        <div class="alert alert-warning" role="alert">
                            <b><i class="fas fa-truck fa-2x fa-pull-right"></i>Pesanan Sedang Diantar</b>
                        </div>
                    <?php elseif ($detail['status_tracking'] == 3) : ?>
                        <div class="alert alert-success" role="alert">
                            <b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Pesanan Sudah Diantar</b>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="heading-menu text-center ftco-animate">
                    <h3>Nota GAKedai - Condet</h3>
                </div>
                <div class="menus ftco-animate">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Customer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; <?php echo $detail['nama']; ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 style="text-align:right;">Order No : &nbsp; <?php echo $detail['id_order']; ?></h6>
                        </div>
                        <div class="col-md-12">
                            <h6>Ongkos Kirim &nbsp; &nbsp; &nbsp;: &nbsp;Rp.<?php echo number_format($detail['tarif']); ?> (<?php echo $detail['nama_daerah']; ?>)</h6>
                        </div>
                        <div class="col-md-12">
                            <h6>Nomor Telepon &nbsp;: &nbsp;<?php echo $detail['no_telepon']; ?></h6>
                        </div>
                        <div class="col-md-12">
                            <h6>Alamat Antar &nbsp; &nbsp; &nbsp;:&nbsp; <?php echo $detail['alamat']; ?></h6>
                        </div>
                        <div class="col-md-12">
                            <h6><?php echo $detail['tanggal_beli']; ?> &nbsp; <?php echo $detail['waktu_beli']; ?></h6>
                        </div>
                    </div>
                </div>
                <!-- Menu -->
                <div class="col-sm-12 menu-wrap">
                    <div class="menus text-center ftco-animate">
                        <table class="table table-borderless">
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
                                    <th colspan="4"> SubTotal </th>
                                    <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4"> Ongkir </th>
                                    <th>Rp.<?php echo number_format($detail['tarif']); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4"> Unique ID </th>
                                    <th>Rp.<?php echo number_format($detail['uniq_id']); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="upload" class="menus text-right ftco-animate">
                        <h4>Total Pembayaran : Rp. <?php echo number_format($detail['total_order']); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <?php if ($detail['buktibayar'] > 0) : ?>
                <div class='col-md-6'>
                    <div class="ftco-animate">
                        <h3>Bukti Bayar Anda</h3>
                        <div class="menus text-center">
                            <img src="buktibayar/<?php echo $detail['buktibayar']; ?>" style="width: 50%; height: 50%" />
                        </div>
                    </div>
                    <?php if ($detail['status_tracking'] <= 2) : ?>
                        <a href="hapusbukti.php?id=<?php echo $detail['id_order']; ?>" class="btn btn-sm btn-danger float-right">Hapus Bukti Bayar</a>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class='col-md-6'>
                    <div class="ftco-animate">
                        <h3>Upload Bukti Bayar</h3>
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" name="buktibayar" id="buktibayar" class="form-control">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" readonly>
                            <button class="btn btn-warning float-right" type="submit" name="submit">
                                <i class="fas fa-upload">
                                </i> Upload
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            <div class='col-md-6'>
                <div class="ftco-animate">
                    <h3>Metode Pembayaran</h3>
                    <div class='alert alert-secondary'>
                        <style>
                            /* Style tab links */
                            .tabmetode {
                                background-color: #555;
                                color: white;
                                float: left;
                                border: none;
                                outline: none;
                                cursor: pointer;
                                padding: 14px 16px;
                                font-size: 17px;
                                width: 25%;
                            }

                            .tabmetode:hover {
                                background-color: #777;
                            }

                            /* Style the tab content (and add height:100% for full page content) */
                            .tabmetodecontent {
                                color: white;
                                display: none;
                                padding: 100px 20px;
                                height: 100%;
                            }

                            #BTPN {
                                background-color: #ff6302;
                            }

                            #GoPay {
                                background-color: #00aa13;
                            }

                            #Dana {
                                background-color: #108de9;
                            }

                            #OVO {
                                background-color: #432575;
                            }
                        </style>
                        <button class="tabmetode" onclick="openPage('BTPN', this, '#ff6302')" id="defaultOpen">BTPN</button>
                        <button class="tabmetode" onclick="openPage('GoPay', this, '#00aa13')">GoPay</button>
                        <button class="tabmetode" onclick="openPage('Dana', this, '#108de9')">Dana</button>
                        <button class="tabmetode" onclick="openPage('OVO', this, '#432575')">OVO</button>
                        <div id="BTPN" class="tabmetodecontent">
                            <div class="menus text-center ftco-animate">
                                <img src="images/btpn_logo.png" style="width: 35%; height: 35%">
                            </div>
                            <div class="text-center ftco-animate">
                                <p><b>No. Rek : 9002-0817-149 </b></p>
                                <p>a/n Prianugrah Widijatmiko</p>
                            </div>
                        </div>

                        <div id="GoPay" class="tabmetodecontent">
                            <div class="menus text-center ftco-animate">
                                <img src="images/gopay_logo.png" style="width: 35%; height: 35%">
                            </div>
                            <div class="text-center ftco-animate">
                                <img src="images/gopay.png" style="width: 100%; height: 100%">
                            </div>

                        </div>

                        <div id="Dana" class="tabmetodecontent">
                            <div class="menus text-center ftco-animate">
                                <img src="images/dana_logo.png" style="width: 35%; height: 35%">
                            </div>
                            <div class="text-center ftco-animate">
                                <img src="images/dana.png" style="width: 100%; height: 100%">
                            </div>
                        </div>

                        <div id="OVO" class="tabmetodecontent">
                            <div class="menus text-center ftco-animate">
                                <img src="images/ovo_logo.png" style="width: 35%; height: 35%">
                            </div>
                            <div class="text-center ftco-animate">
                                <img src="images/ovo.png" style="width: 100%; height: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-12'>
                <div class="ftco-animate">
                    <a href="myorder.php" class="btn btn-secondary float-right">Kembali ke Daftar Order Saya</a>
                </div>
            </div>
        </div>
</section>
<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabmetodecontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tabmetode");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?php
include 'includes/footer.php';
?>