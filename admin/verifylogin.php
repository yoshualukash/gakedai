<?php
include 'connection.php';
$username = $_POST['admusername'];
$password = $_POST['admpassword'];
$sql1 = "SELECT * FROM `account_admin` WHERE username='$username'";
// $sql2 = "SELECT * FROM `admin` WHERE pass='$pwd'";
$result1 = mysqli_query($conn, $sql1);
// $result2 = mysqli_query($conn, $sql2);

$num1 = mysqli_num_rows($result1);
if ($num1 === 1) {
    session_start();
    $row = mysqli_fetch_assoc($result1);
    if (password_verify($password, $row['password'])) {
        $_SESSION['password'] = true;
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        echo "<script>
			alert('Selamat datang, $username !');
			document.location.href = 'index.php';
				</script>";
        exit;
    } else if ($password != $row['password']) {
        echo "<script>
			alert('Username / Password anda salah!');
			document.location.href = 'login.php';
				</script>";
    }
}
