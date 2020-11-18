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
    <li class="nav-item active"><a href="about.php" class="nav-link">About</a></li>
    <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
    <?php include 'includes/navbar.php'; ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">About</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
    </section>


    <section class="ftco-section ftco-wrap-about ftco-no-pb ftco-no-pt">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-sm-5 img img-2 d-flex align-items-center justify-content-center justify-content-md-end" style="background-image: url(images/kedai-kopi.jpg); position: relative">
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
              $sql = "SELECT * FROM pesan_saran WHERE status_review ='1' ORDER BY id";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) { ?>
                <div class="item">
                  <div class="testimony-wrap text-center py-4 pb-5">
                    <div class="user-img mb-4" style="background-image: url(images/defaultadmin.png)">
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