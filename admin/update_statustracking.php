<?php
session_start();
if (isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
}
if (!isset($_SESSION['password'])) {
    header('location:login.php');
} else if (isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
}
$conn = mysqli_connect("localhost", "root", "", "gakedai") or
    die('Could not connect to the database!');

mysqli_select_db($conn, "gakedai") or
    die('No database selected!');
if (!isset($_POST['status_tracking'])) {
    header('location:index.php');
}
$id = $_POST['id_order'];
$status_tracking = $_POST['status_tracking'];

$sql = "UPDATE daftar_order SET status_tracking = '$status_tracking' WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Status telah diperbarui!');
			</script>";
    header('location:listOrder.php');
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
