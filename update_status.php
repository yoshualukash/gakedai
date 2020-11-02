<?php
$id = $_GET['id'];

require '../functions.php';

$sql = "UPDATE daftar_order SET buktibayar = null WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    header('location:myorder.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
