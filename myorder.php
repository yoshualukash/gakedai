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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST["tombolbukti"])) {
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>
<script type="text/javascript">
    function confirmDelOrder() {
        var x = confirm("Anda yakin ingin membatalkan order?");

        if (x == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
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
                <h1 class="mb-2 bread">My Order</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="profile.php">Profile </a><i class="ion-ios-arrow-forward"></i></span></span><span>My Order <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<section class="ftco-section">
    <div class="container ftco-animate">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Gakedai</span>
                <h2 class="mb-4">Daftar Order <?php echo $username; ?></h2>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12'>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Order</th>
                                <th scope="col">Tanggal Beli</th>
                                <th scope="col">Total Order</th>
                                <th scope="col">Status Bayar</th>
                                <th scope="col">Status Order</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM daftar_order WHERE id_pelanggan='$id_user' AND status_tracking<='2'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><b><?php echo $row['id_order']; ?></b></td>
                                    <td><b><?php echo $row['tanggal_beli']; ?></b></td>
                                    <td><b>Rp. <?php echo number_format($row['total_order']); ?></b></td>
                                    <!-- If Else Status Bayar-->
                                    <?php if ($row['status_pesan'] == 0) : ?>
                                        <td style="color:red"><b><i class="fas fa-times fa-2x fa-pull-right"></i>Belum Lunas</b></td>
                                    <?php elseif ($row['status_pesan'] == 1) : ?>
                                        <td style="color:grey">
                                            <b><i class="fa fa-spinner fa-2x fa-pull-right fa-spin"></i>Bukti bayar sedang dicek</b></td>
                                    <?php elseif ($row['status_pesan'] == 2) : ?>
                                        <td style="color:green"><b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Sudah Lunas</b></td>
                                    <?php endif; ?>
                                    <!-- If Else Status Order -->
                                    <?php if ($row['status_tracking'] == 0) : ?>
                                        <td style="color:red"><b><i class="fas fa-times fa-2x fa-pull-right"></i>Pesanan Belum Dibuat</b></td>
                                    <?php elseif ($row['status_tracking'] == 1) : ?>
                                        <td style="color:#E67E22"><b><i class="fas fa-lightbulb fa-2x fa-pull-right"></i>Pesanan Sedang Dibuat</b></td>
                                    <?php elseif ($row['status_tracking'] == 2) : ?>
                                        <td style="color:#D4AC0D"><b><i class="fas fa-truck fa-2x fa-pull-right"></i>Pesanan Sedang Diantar</b></td>
                                    <?php elseif ($row['status_tracking'] == 3) : ?>
                                        <td style="color:green"><b><i class="fas fa-check-circle fa-2x fa-pull-right"></i>Pesanan Sudah Diantar</b></td>
                                    <?php endif; ?>
                                    <!-- If Else Bukti Bayar -->
                                    <?php if ($row['buktibayar'] > 0) : ?>
                                        <td><u><a style="color:blue" href="buktibayar/<?php echo $row['buktibayar']; ?>">
                                                    <h6 style="text-align:center;"><b>Lihat Bukti</b></h6>
                                                </a></u>
                                            <hr>
                                            <a class="btn btn-danger btn-sm float-right" href="hapusbuktimyorder.php?id=<?php echo $row['id_order']; ?>">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </td>
                                    <?php else : ?>
                                        <td>Belum ada bukti bayar
                                            <hr>
                                            <a class="btn btn-warning btn-sm float-right" href="nota.php?id=<?php echo $row['id_order']; ?>#upload">
                                                <i class="fas fa-upload">
                                                </i> Upload
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="nota.php?id=<?php echo $row['id_order']; ?>">
                                            <i class="fas fa-eye">
                                            </i>&nbsp;&nbsp;Lihat Nota
                                        </a>
                                        <hr>
                                        <a class="btn btn-danger btn-sm" onclick="return confirmDelOrder()" href="hapusorder.php?id=<?php echo $row['id_order']; ?>">
                                            <i class="fas fa-trash">
                                            </i>&nbsp;&nbsp;Cancel Order
                                        </a>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Bukti Pembayaran -->
            <?php #if (isset($_GET['id_order'])) : 
            ?>
            <!-- <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Upload bukti pembayaran</h2>
                                <a href="myorder.php">X</a>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <input type="file" name="buktibayar" id="buktibayar" class="form-control" required>
                                    <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id_order']; ?>" readonly>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-warning" type="submit" name="tombolbukti">
                                        Upload
                                    </button>
                                    <a href="myorder.php" class="btn btn-secondary">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            <?php # endif; 
            ?>
        </div>
    </div>
</section>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<?php
include 'includes/footer.php';
?>