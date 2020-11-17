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
?>

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
                <h1 class="mb-2 bread">Profile User</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="profile.php">Profile </a></span>
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
                <h2 class="mb-4">Profile User</h2>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM account_google WHERE id='$id_user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result); ?>
        <div class='row'>
            <div class='col-md-4'>
                <img src="<?php echo $row['picture']; ?>" style="width: 100%; height: 100%">
            </div>
            <div class='col-md-8'>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td><b><?php echo $row['nama']; ?></b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Email</td>
                            <td><b><?php echo $row['email']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Tanggal Register</td>
                            <td><b><?php echo $row['tanggal_register']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Total Order Belum Lunas</td>
                            <?php $sql1 = "SELECT * FROM daftar_order WHERE id_pelanggan='$id_user' AND status_pesan='0' AND status_tracking<='2'";
                            $result = mysqli_query($conn, $sql1);
                            $row1 = mysqli_num_rows($result); ?>
                            <td><b><?php echo $row1; ?></b></td>
                        </tr>
                        <tr>
                            <td>Total Order Lunas</td>
                            <?php $sql1 = "SELECT * FROM daftar_order WHERE id_pelanggan='$id_user' AND status_tracking='3'";
                            $result = mysqli_query($conn, $sql1);
                            $row1 = mysqli_num_rows($result); ?>
                            <td><b><?php echo $row1; ?></b></td>
                        </tr>
                    </tbody>
                </table>
                <a href="myorder.php" class="btn btn-sm btn-danger float-right">Lihat Order Saya</a>
            </div>
        </div>
</section>
<?php
include 'includes/footer.php';
?>