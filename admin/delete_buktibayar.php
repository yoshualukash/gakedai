<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "UPDATE daftar_order SET buktibayar = '' WHERE id_order='$id'";
$sqlstatus = "UPDATE daftar_order SET status_pesan = '0' WHERE id_order='$id'";
if (mysqli_query($conn, $sql)) {
    if (mysqli_query($conn, $sqlstatus)) {
        echo "<script>
            alert('Bukti bayar telah dihapus!');
			</script>";
        header('location:listOrder.php');
    }
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
