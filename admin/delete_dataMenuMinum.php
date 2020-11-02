<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM tblmenu WHERE type='Minuman' and id=$id";
if (mysqli_query($conn, $sql)) {
    header('location:listMinuman.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
