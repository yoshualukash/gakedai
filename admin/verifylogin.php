<?php
include 'connection.php';
if (!isset($_POST['adminsubmit'])) {
    echo "<script>window.location.assign('login.php')</script>";
} else {
    $username = $_POST['admusername'];
    $password = $_POST['admpassword'];
    $sql1 = "SELECT * FROM `account_admin` WHERE username='$username'";
    $result1 = mysqli_query($conn, $sql1);

    $num1 = mysqli_num_rows($result1);
    if ($num1 === 1) {
        $row = mysqli_fetch_assoc($result1);
        if (password_verify($password, $row['password'])) {
            session_start();
            $nama_admin = $row['nama'];
            $_SESSION['password'] = true;
            $_SESSION['password'] = $password;
            $_SESSION['username'] = $username;
            $_SESSION['nama_admin'] = $nama_admin;
            echo "<script>
			alert('Selamat datang, $nama_admin !');
                </script>";
            echo "<script>window.location.assign('index.php')</script>";
        } else if ($password != $row['password']) {
            echo "<script>
			alert('Username / Password anda salah!');
                </script>";
            echo "<script>window.location.assign('login.php')</script>";
        }
    } else {
        echo "<script>
    alert('Username / Password anda salah!');
        </script>";
        echo "<script>window.location.assign('login.php')</script>";
    }
}
