<?php
session_start();
include("connection.php");
$id = $_POST['id'];
$status_review = $_POST['status_review'];
$_SESSION['id'] = $id;

$sql = "UPDATE pesan_saran SET status_review = '$status_review' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Status Review telah diperbarui!');
        </script>";
    header('location:list_review.php');
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
