<?php
include("connection.php");
if (!isset($_POST['update_statusmenumakan'])) {
    header('location:index.php');
}
$id = $_POST['id'];
$status_menu = $_POST['status_menu'];

$sql = "UPDATE tblmenu SET status_menu = '$status_menu' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Status menu makanan telah diperbarui!');
            document.location.href = 'listMakanan.php';
			</script>";
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
