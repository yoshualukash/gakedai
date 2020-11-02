<?php
if (!isset($_SESSION)) {
	session_start();
}
require 'functions.php';
include 'includes/header.php';
include_once 'config.php';
if (isset($_SESSION['login'])) {
	$username = $_SESSION['username'];
} elseif (isset($_SESSION['google_login'])) {
	$username = $_SESSION['nama'];
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
						<h1 class="mb-2 bread">Menu</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu <i class="ion-ios-arrow-forward"></i></span></p>
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
						<h2 class="mb-4">Our Menu</h2>
					</div>
				</div>
				<div class="row">
					<!-- Makanan Row -->
					<div class="col-sm-8 menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Makanan</h3>
						</div>
						<!-- Menu -->
						<?php
						$sql1 = "SELECT * FROM tblmenu WHERE type='Makanan' ORDER BY name ASC";
						$result = mysqli_query($conn, $sql1);
						while ($row = mysqli_fetch_array($result)) { ?>
							<div class="menus d-flex ftco-animate">
								<div class="menu-img img zoom" style="background-image: url(menu_image/<?php echo $row['photo']; ?>);"></div>
								<div class="text">
									<div class="d-flex">
										<div class="one-half">
											<h3><?php echo $row['name']; ?></h3>
										</div>
										<div class="one-forth">
											<span class="price">Rp<?php echo number_format($row['price']); ?></span>
										</div>
									</div>
									<p><span><?php echo $row['detail']; ?></span></p>
									<div class="clearfix" role="group" aria-label="Basic example">
										<a href="beli.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success float-right">Add to cart</a>
									</div>
								</div>
							</div>
						<?php }; ?>
					</div>
					<div class="col-sm-4 menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>🛒 Pesanan Anda </h3>
						</div>
						<div class="menus text-center ftco-animate">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">Produk</th>
										<th scope="col">Harga</th>
										<th scope="col">Jumlah</th>
										<th scope="col">SubHarga</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($_SESSION['keranjang'])) : ?>
										<?php $totalbelanja = 0; ?>
										<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
											<?php $sql3 = "SELECT * FROM tblmenu WHERE id = '$id_produk'";
											$result = mysqli_query($conn, $sql3);
											$row3 = mysqli_fetch_array($result);
											$subharga = $row3['price'] * $jumlah;

											?>
											<tr>
												<th><?php echo $row3['name']; ?></th>
												<td>Rp.<?php echo number_format($row3['price']); ?></td>
												<td><?php echo $jumlah; ?></td>
												<td>Rp.<?php echo number_format($subharga); ?></td>
												<td><a style="color:green" href="tambahitem.php?id=<?php echo $id_produk; ?>">Tambah 1</a>
													<a href="hapusitem.php?id=<?php echo $id_produk; ?>">Hapus 1</a></td>
											</tr>
											<?php $totalbelanja += $subharga; ?>
										<?php endforeach; ?>
									<?php else : ?>
									<?php endif; ?>
								</tbody>
								<tfoot>
									<?php if (isset($_SESSION['keranjang'])) : ?>
										<tr>
											<th colspan="4"> Total Belanja </th>
											<th>Rp.<?php echo number_format($totalbelanja); ?></th>
										</tr>
										<tr>
											<th colspan="5"><a href="checkout.php" class="btn btn-sm btn-warning float-right">Checkout</a></th>
										</tr>
									<?php else : ?>
										<tr>
											<th colspan="4"> Total Belanja </th>
											<th>Rp. 0</th>
										</tr>
									<?php endif; ?>


								</tfoot>
							</table>
						</div>
					</div>
					<!-- Minuman Row -->
					<div class="col-sm-8 menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Minuman</h3>
						</div>
						<?php
						$sql2 = "SELECT * FROM tblmenu WHERE type='Minuman' ORDER BY name ASC";
						$result = mysqli_query($conn, $sql2);
						while ($row = mysqli_fetch_array($result)) { ?>
							<div class="menus d-flex ftco-animate">
								<div class="menu-img img zoom" style="background-image: url(menu_image/<?php echo $row['photo']; ?>);"></div>
								<div class="text">
									<div class="d-flex">
										<div class="one-half">
											<h3><?php echo $row['name']; ?></h3>
										</div>
										<div class="one-forth">
											<span class="price">Rp<?php echo number_format($row['price']); ?></span>
										</div>
									</div>
									<p><span><?php echo $row['detail']; ?></span></p>
									<div class="clearfix" role="group" aria-label="Basic example">
										<a href="beli.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success float-right">Add to cart</a>
									</div>
								</div>
							</div>
						<?php }; ?>
					</div>
				</div>

		</section>
		<?php
		include 'includes/footer.php';
		?>