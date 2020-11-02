<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM pesan_saran WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header('location:list_review.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
