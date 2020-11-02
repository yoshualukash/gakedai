<?php
$conn = mysqli_connect("localhost", "root", "", "gakedai") or
    die('Could not connect to the database!');
mysqli_select_db($conn, "gakedai") or
    die('No database selected!');
if (!isset($_POST['update_statusmenuminum'])) {
    header('location:index.php');
}
$id = $_POST['id'];
$status_menu = $_POST['status_menu'];

$sql = "UPDATE tblmenu SET status_menu = '$status_menu' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Status menu minuman telah diperbarui!');
            document.location.href = 'listMinuman.php';
			</script>";
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
