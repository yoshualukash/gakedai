<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'functions.php';
//Google Account Login
include_once 'config.php';
//Jika user sudah authentication dan memilih email google untuk login akan cek code authenticationnya
if (isset($_SESSION["google_login"])) {
    header("Location: menu.php");
    exit;
}
if (isset($_SESSION['token'])) {
    $google_client->setAccessToken($_SESSION['token']);
}
if (isset($_GET['code'])) {
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['token'] = $google_client->getAccessToken();

    //Get User's Information after receiving access token
    $userData = $google_service->userinfo->get();

    //Pass all the user info needed and store it into database
    $oauth_provider = "google";
    $oauth_uid = $userData->id;
    $nama = $userData->name;
    $nama_depan = $userData->givenName;
    $email = $userData->email;
    $picture = $userData->picture;
    //Before inserting into database, check if account already exist 
    $result1 = mysqli_query($conn, "SELECT email FROM account_google WHERE email = '$email'");
    //If account already exist in google database, login instead
    if (mysqli_fetch_assoc($result1)) {
        $_SESSION['google_login'] = true;
        $_SESSION['nama'] = $nama_depan;
        $_SESSION['email'] = $email;
        $result3 = mysqli_query($conn, "SELECT * FROM account_google WHERE email = '$email'");
        $row3 = mysqli_fetch_assoc($result3);
        $_SESSION['id_user'] = $row3['id'];
        $_SESSION['id'] = $oauth_uid;
        echo "<script>
			alert('Selamat datang kembali $nama !');
			document.location.href = 'menu.php';
            </script>";
    } else {
        //If not exist, Insert account data info into database
        $tanggal_register = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO account_google VALUES('', '$nama', '$nama_depan', '$email', '', '$picture', '$oauth_provider', '$oauth_uid', '$tanggal_register')");
        mysqli_affected_rows($conn);
        $_SESSION['google_login'] = true;
        $_SESSION['nama'] = $nama_depan;
        $_SESSION['fullnama'] = $nama;
        $_SESSION['id'] = $oauth_uid;
        $_SESSION['email'] = $email;
        $result3 = mysqli_query($conn, "SELECT * FROM account_google WHERE email = '$email'");
        $row3 = mysqli_fetch_assoc($result3);
        $_SESSION['id_user'] = $row3['id'];
        echo "<script>
			alert('Berhasil mendaftar!');
			</script>";
        echo "<script>
			alert('Selamat datang, $nama !');
			document.location.href = 'emailwelcome.php';
            </script>";
    }
}
//Jika user belum authentication, maka akan redirect ke halaman authentication
else {
    $authUrl = $google_client->createAuthUrl();
    // $output = '<a href="' . filter_var($authUrl, FILTER_SANITIZE_URL) . '"><img src="images/google-sign-in-btn.png" alt=""/></a>';
    $data['authUrl'] = $authUrl;
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GAKedai Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Logo Icon GAKedai -->
    <link rel="icon" href="images/logo_gakedai.png" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
    .avatarround {
        vertical-align: middle;
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
</style>
<a href="index.php"><img src="https://i.ibb.co/t4rrY8K/logo-gakedai.png" class="avatarround" width="200" height="200" style="display: block;"></a>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>GAK</b>edai Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="social-auth-links text-center mb-3">
                    <p class="login-box-msg">Login ke akun <b>GAKedai</b> anda</p>
                    <a href="#" class="btn btn-block btn-danger" onclick="window.location = '<?php echo $authUrl; ?>'" name="login-google">
                        <i class="fab fa-google mr-2"></i> Login using Google
                    </a>
                </div>
                <!-- /.social-auth-links -->
                <p class="mb-0">
                    Are you an admin?<a href="admin/login.php" class="text-center"> Login here</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

</body>

</html>