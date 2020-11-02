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
		<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
		<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
		<li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
		<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
		<?php include 'includes/navbar.php'; ?>

		<section class="home-slider js-fullheight owl-carousel bg-white">
			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
					<div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
						<div class="one-third order-md-last img js-fullheight" style="background-image:url(images/kedai.jpg);">
							<div class="overlay"></div>
						</div>
						<div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<div class="text mt-md-5">
								<h1 class="mb-4">Selamat Datang di<br> GAKedai</h1>
								<p>Praktis. Higienis. Lezat.</p>
								<div class="thumb mt-4 mb-3 d-flex">
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/thumbs-up.jpg);"></div>
										<h4>Praktis</h4>
									</a>
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/higienis.jpg);"></div>
										<h4>Higienis</h4>
									</a>
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/lezat.jpg);"></div>
										<h4>Lezat</h4>
									</a>
								</div>
								<p><a href="menu.php" class="btn btn-primary px-4 py-3 mt-3">Pesan Sekarang</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
					<div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
						<div class="one-third order-md-last img js-fullheight" style="background-image:url(images/kedai-kopi.jpg);">
							<div class="overlay"></div>
						</div>
						<div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<div class="text mt-md-5">
								<h1 class="mb-4">Selamat Datang di<br> GAKedai</h1>
								<p>Praktis. Higienis. Lezat.</p>
								<div class="thumb mt-4 mb-3 d-flex">
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/thumbs-up.jpg);"></div>
										<h4>Praktis</h4>
									</a>
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/higienis.jpg);"></div>
										<h4>Higienis</h4>
									</a>
									<a href="#" class="thumb-menu pr-md-4 text-center">
										<div class="img" style="background-image: url(images/lezat.jpg);"></div>
										<h4>Lezat</h4>
									</a>
								</div>
								<p><a href="menu.php" class="btn btn-primary px-4 py-3 mt-3">Pesan Sekarang</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="ftco-section ftco-wrap-about ftco-no-pb ftco-no-pt">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-sm-5 img img-2 d-flex align-items-center justify-content-center justify-content-md-end" style="background-image: url(images/kedai-kopi.jpg); position: relative">
						<a href="#" class=" popup-vimeo d-flex justify-content-center align-items-center">
						</a>
					</div>
					<div class="col-sm-7 wrap-about py-5 ftco-animate">
						<div class="heading-section mt-5 mb-4">
							<div class="pl-lg-5 ml-md-5">
								<span class="subheading">About</span>
								<h2 class="mb-4">Welcome to GAKedai</h2>
							</div>
						</div>
						<div class="pl-lg-5 ml-md-5">
							<p>Restoran GAKedai memiliki kualitas yang tinggi dan suasana yang santai. GAKedai berada di daerah condet yang letaknya tak jauh dari keramaian anak muda. Bangunan dan dekorasinya menawan dan bergaya cafe, dengan sentuhan modern yang elegan. Anda juga dapat duduk di bangku luar ruangan yang menghadap ke lapangan terbuka. Menu harian termasuk ayam, sphagetti, hingga pancake dihidangkan dengan nikmat seharga kantong mahasiswa.</p>
							<h3 class="mt-5">Special Recipe</h3>
							<div class="thumb my-4 d-flex">
								<a href="menu.php" class="thumb-menu pr-md-4 text-center">
									<div class="img" style="background-image: url(menu_image/5f95bdf134d03.jpg);"></div>
									<h4>Chicken Wings</h4>
								</a>
								<a href="menu.php" class="thumb-menu pr-md-4 text-center">
									<div class="img" style="background-image: url(menu_image/5f95c7fa1c7f0.jpg);"></div>
									<h4>Sphagetti</h4>
								</a>
								<a href="menu.php" class="thumb-menu pr-md-4 text-center">
									<div class="img" style="background-image: url(menu_image/5f95c8d61e4c9.jpg);"></div>
									<h4>Red Velvet Milk</h4>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
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
					<div class="col-sm-6 menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Makanan</h3>
						</div>
						<!-- Menu -->
						<?php
						$sql = "SELECT * FROM tblmenu WHERE type='Makanan'LIMIT 5";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($result)) { ?>
							<div class="menus d-flex ftco-animate">
								<div class="menu-img img zoom" style="background-image: url(menu_image/<?php echo $row['photo']; ?>);"></div>
								<div class="text">
									<div class="d-flex">
										<div class="one-half">
											<h3><?php echo $row['name']; ?></h3>
										</div>
										<div class="one-forth">
											<span class="price">Rp.<?php echo $row['price']; ?></span>
										</div>
									</div>
									<p><span><?php echo $row['detail']; ?></span></p>
									<div class="clearfix" role="group" aria-label="Basic example">
										<a href="menu.php" class="btn btn-sm btn-success float-right">Pesan</a>
									</div>
								</div>
							</div>
						<?php }; ?>
					</div>
					<!-- Minuman Row -->
					<div class="col-sm-6 menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Minuman</h3>
						</div>
						<?php
						$sql = "SELECT * FROM tblmenu WHERE type='Minuman' LIMIT 6";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($result);
						while ($row = mysqli_fetch_array($result)) { ?>
							<div class="menus d-flex ftco-animate">
								<div class="menu-img img zoom" style="background-image: url(menu_image/<?php echo $row['photo']; ?>);"></div>
								<div class="text">
									<div class="d-flex">
										<div class="one-half">
											<h3><?php echo $row['name']; ?></h3>
										</div>
										<div class="one-forth">
											<span class="price">Rp.<?php echo number_format($row['price']); ?></span>
										</div>
									</div>
									<p><span><?php echo $row['detail']; ?></span></p>
									<div class="clearfix" role="group" aria-label="Basic example">
										<a href="menu.php" class="btn btn-sm btn-success float-right">Pesan</a>
									</div>
								</div>
							</div>
						<?php }; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center ftco-animate">
						<p><a href="menu.php" class="btn btn-black py-3 px-5">View All Menu</a></p>
					</div>
				</div>
			</div>

		</section>

		<section class="ftco-section testimony-section" style="background-image: url(images/bg_5.jpg);" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<span class="subheading">Testimoni</span>
						<h2 class="mb-4">Pelanggan</h2>
					</div>
				</div>
				<div class="row ftco-animate justify-content-center">
					<div class="col-md-7">
						<div class="carousel-testimony owl-carousel ftco-owl">
							<?php
							$sql = "SELECT * FROM pesan_saran ORDER BY id ";
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($result)) { ?>
								<div class="item">
									<div class="testimony-wrap text-center py-4 pb-5">
										<div class="user-img mb-4" style="background-image: url(images/admin1.jpg)">
											<span class="quote d-flex align-items-center justify-content-center">
												<i class="icon-quote-left"></i>
											</span>
										</div>
										<div class="text p-3">
											<p class="mb-4"><?php echo $row['pesan']; ?></p>
											<p class="name"><?php echo $row['nama']; ?></p>
											<span class="position">Pelanggan</span>
										</div>
									</div>
								</div>
							<?php }; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		include 'includes/footer.php';
		?>