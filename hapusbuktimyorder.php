<?php
$id = $_GET['id'];

require 'functions.php';

$sql = "UPDATE daftar_order SET buktibayar = null WHERE id_order='$id'";
$sqlstatus = "UPDATE daftar_order SET status_pesan = '0' WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    if (mysqli_query($conn, $sqlstatus)) {
        echo "<script>
        alert('Berhasil menghapus bukti bayar!');
        document.location.href = 'myorder.php';</script>";
    }
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
