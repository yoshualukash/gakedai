<?php
$conn = mysqli_connect("localhost", "root", "", "gakedai") or
    die('Could not connect to the database!');
mysqli_select_db($conn, "gakedai") or
    die('No database selected!');
if (!isset($_POST['update_listmakan'])) {
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
            alert('Menu Makanan telah diperbarui!');
            document.location.href = 'listMakanan.php';
			</script>";
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
