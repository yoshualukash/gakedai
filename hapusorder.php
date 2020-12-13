<?php
$id = $_GET['id'];

require 'functions.php';

$sqlstatus = "UPDATE daftar_order SET status_tracking = '5' WHERE id_order='$id'";

if (mysqli_query($conn, $sqlstatus)) {
    echo "<script>
            alert('Order telah anda batalkan!');
			</script>";
    header('location:emailhapusorderuser.php?id=' . $id);
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
