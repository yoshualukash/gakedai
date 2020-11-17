<?php
session_start();
include("connection.php");
$id = $_POST['id_order'];
$status_pesan = $_POST['status_pesan'];
$_SESSION['id_order'] = $id;

$sql = "UPDATE daftar_order SET status_pesan = '$status_pesan' WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    if ($status_pesan == '2') {
        echo "<script>
        alert('Status telah diperbarui!');
        </script>";
        header('location:../emailstatusbayarclear.php');
    } else {
        echo "<script>
        alert('Status telah diperbarui!');
        </script>";
        header('location:listOrder.php');
    }
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
