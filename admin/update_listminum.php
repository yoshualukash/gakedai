<?php
include("connection.php");
if (!isset($_POST['update_listminum'])) {
    header('location:index.php');
}
$id = $_POST['id'];
$name = $_POST['name'];
$code = $_POST['code'];
$price = $_POST['price'];
$type = $_POST['type'];
$detail = $_POST['detail'];

$sql = "UPDATE tblmenu SET `name` = '$name', code = '$code', price = '$price', `type` = '$type', detail = '$detail' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Menu Minuman telah diperbarui!');
            document.location.href = 'listMinuman.php';
			</script>";
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
