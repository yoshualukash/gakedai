<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM account_usr WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Bukti bayar berhasil dihapus!');
			</script>";
    header('location:list_accUsr.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
