<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
include 'includes/header.php';
include_once 'config.php';

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
if (!isset($_SESSION['keranjang'])) {
    header("Location: menu.php");
    exit;
}
?>

<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item active"><a href="menu.php" class="nav-link">Menu</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php include 'includes/navbar.php'; ?>

        <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-2 bread">Checkout</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="menu.php">Menu <i class="ion-ios-arrow-forward"></i></a></span><span>Checkout <i class="ion-ios-arrow-forward"></i></span>
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
                        <h2 class="mb-4">Checkout</h2>
                    </div>
                </div>
                <div class="heading-menu text-center ftco-animate">
                    <h3>🛒 Detail Pesanan Anda 🛒</h3>
                </div>
                <!-- Menu -->
                <div class="col-sm-12 menu-wrap">
                    <div class="menus text-center ftco-animate">
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
                                <?php if (isset($_SESSION['keranjang'])) : ?>
                                    <?php $totalbelanja = 0; ?>
                                    <?php $iter = 1; ?>
                                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                                        <?php $sql3 = "SELECT * FROM tblmenu WHERE id = '$id_produk'";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $row3 = mysqli_fetch_array($result3);
                                        $subharga = $row3['price'] * $jumlah;

                                        ?>
                                        <tr>
                                            <th><?php echo $iter; ?></th>
                                            <th><?php echo $row3['name']; ?></th>
                                            <td>Rp.<?php echo number_format($row3['price']); ?></td>
                                            <td><?php echo $jumlah; ?></td>
                                            <td>Rp.<?php echo number_format($subharga); ?></td>
                                        </tr>
                                        <?php $totalbelanja += $subharga; ?>
                                        <?php $iter += 1; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"> Total Belanja </th>
                                    <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="5"><a href="menu.php" class="btn btn-sm btn-success float-right ">Tambah Item</a></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="heading-menu text-center ftco-animate">
                        <h3>Informasi Pengantaran</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Nama Anda :</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama" value="<?php echo $username; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Nomor Telepon :</h5>
                                <div class="form-group">
                                    <input type="tel" pattern="^\d{12|13}$" class="form-control" name="no_telepon" placeholder="Nomor Telepon" maxlength="13">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Alamat Antar:</h5>
                                <textarea name="alamat" cols="30" rows="7" class="form-control" placeholder="Alamat Antar"></textarea>
                            </div>
                            <div class="col-md-6">
                                <h5>Pilih Ongkos Kirim:</h5>
                                <div class="form-group">
                                    <select class="form-control" name="id_ongkir">
                                        <option value="">Pilih Ongkos Kirim</option>
                                        <?php $sql1 = "SELECT * FROM ongkir";
                                        $result1 = mysqli_query($conn, $sql1);
                                        while ($row1 = mysqli_fetch_array($result1)) { ?>
                                            <option value="<?php echo $row1['id_ongkir']; ?>"><?php echo $row1['nama_daerah']; ?> -
                                                Rp. <?php echo number_format($row1['tarif']); ?>

                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" name="checkout">Checkout</button>
                    </form>

                    <?php if (isset($_POST['checkout'])) {
                        $id_pelanggan = $id_user;
                        $id_ongkir = $_POST['id_ongkir'];
                        $tanggal_beli = date("Y-m-d");
                        date_default_timezone_set("Asia/Jakarta");
                        $waktu_beli = date("H:i:s");
                        $alamat = $_POST['alamat'];
                        $no_telepon = $_POST['no_telepon'];

                        $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                        $arrayongkir = $ambil->fetch_assoc();
                        $tarif = $arrayongkir['tarif'];
                        $nama_daerahnya = $arrayongkir['nama_daerah'];
                        $total_order = $totalbelanja + $tarif;

                        //Menyimpan data ke tabel order
                        $sql5 = "INSERT INTO daftar_order(id_pelanggan, id_ongkir, tanggal_beli, waktu_beli, total_order, no_telepon, nama_daerah, tarif, alamat) VALUES('$id_pelanggan', '$id_ongkir', '$tanggal_beli', '$waktu_beli', '$total_order', '$no_telepon', '$nama_daerahnya', '$tarif', '$alamat')";
                        $result5 = mysqli_query($conn, $sql5);
                        //ID pembelian barusan
                        $id_pembelian_barusan = $conn->insert_id;
                        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                            //Mendapatkan data produk berdasarkan id_product
                            $sql7 = "SELECT * FROM tblmenu WHERE id='$id_produk'";
                            $result7 = mysqli_query($conn, $sql7);
                            $row7 = mysqli_fetch_array($result7);
                            $nama_produk = $row7['name'];
                            $harga_produk = $row7['price'];

                            //Masukkan ke tabel pembelian produk
                            $sql6 = "INSERT INTO pembelian_produk(id_order, id_produk, jumlah, nama_produk, harga) VALUES('$id_pembelian_barusan', '$id_produk', '$jumlah', '$nama_produk', '$harga_produk')";
                            $result6 = mysqli_query($conn, $sql6);
                        }
                        //Mengosongkan keranjang session
                        unset($_SESSION['keranjang']);
                        //Tampilan dialihkan kehalaman nota pembelian barusan
                        // echo "<script>alert('Pembelian Sukses!);</script>";
                        // echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
                        echo "<script>
			            alert('Pembelian Sukses!');
			            document.location.href = 'nota.php?id=$id_pembelian_barusan';
                        </script>";
                    } ?>
                </div>
        </section>
        <?php
        include 'includes/footer.php';
        ?>