<?php
session_start();
include("connection.php");
date_default_timezone_set("Asia/Jakarta");
$waktu_selesai = date("H:i:s");
$id = $_POST['id_order'];
$status_tracking = $_POST['status_tracking'];
$_SESSION['id_order'] = $id;

$sql = "UPDATE daftar_order SET status_tracking = '$status_tracking' WHERE id_order='$id'";
$sql_waktuselesai = "UPDATE daftar_order SET waktu_selesai = '$waktu_selesai' WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    if ($status_tracking == '2') {
        echo "<script>
        alert('Status telah diperbarui!');
        </script>";
        header('location:../emailstatusorderantar.php');
    } elseif ($status_tracking == '3') {
        mysqli_query($conn, $sql_waktuselesai);
        echo "<script>
        alert('Status telah diperbarui!');
        </script>";
        header('location:../emailstatusorderclear.php');
    } else {
        echo "<script>
        alert('Status telah diperbarui!');
        </script>";
        header('location:listOrder.php');
    }
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
