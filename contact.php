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
if (isset($_POST['send_message'])) {
    if (send_message($_POST) > 0) {
        echo "<script>
          alert('Pesan/Saran anda telah dikirim!');
          </script>";
        echo "<script>
          alert('Terima Kasih!');
          document.location.href = 'contact.php';
          </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>


<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
        <li class="nav-item active"><a href="contact.php" class="nav-link">Contact</a></li>
        <?php include 'includes/navbar.php'; ?>

        <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-2 bread">Contact Us</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section ftco-no-pt ftco-no-pb contact-section bg-light">
            <div class="container">
                <div class="row d-flex align-items-stretch no-gutters">
                    <div class="col-md-6 p-5 order-md-last">
                        <h2 class="h4 mb-5 font-weight-bold">Write a review about GAKedai!</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="judul" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea name="pesan" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="send_message" value="Send Message" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 p-5 order-md-last">
                        <h2 class="h4 mb-5 font-weight-bold">Visit Us!</h2>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8521701827212!2d106.85704931476951!3d-6.283155995452421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f342ed16e373%3A0x1cfeb221c668297e!2sGAKedai!5e0!3m2!1sen!2sid!4v1605602805918!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section contact-section bg-light">
            <div class="container">
                <div class="row d-flex mb-5 contact-info">
                    <div class="col-md-12 mb-4">
                        <h2 class="h4 font-weight-bold">Contact Information</h2>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-3 d-flex">
                        <div class="dbox">
                            <p><span>Address:</span></p>
                            <p><a href="https://g.page/gakedai">Jl. Batu Ampar II No.49, RT.6/RW.3, Batu Ampar, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13520</a></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="dbox">
                            <p><span>Phone: </span></p>
                            <p><a href="http://wa.me/6281382526988">+62 813-8252-6988</a></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="dbox">
                            <p><span>Email:</span></p>
                            <p><a href="mailto:gakkedai@gmail.com">gakkedai@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="dbox">
                            <p><span>Website:</span></p>
                            <p><a href="https://www.gakedai.com">gakedai.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>