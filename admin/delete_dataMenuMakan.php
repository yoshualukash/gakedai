<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM tblmenu WHERE type='Makanan' and id=$id";
if (mysqli_query($conn, $sql)) {
    header('location:listMakanan.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
