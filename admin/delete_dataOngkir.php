<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM ongkir WHERE id_ongkir=$id";
if (mysqli_query($conn, $sql)) {
    header('location:listOngkir.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
