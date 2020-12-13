<?php
$id = $_GET['delID'];

include('connection.php');
$_SESSION['id_order'] = $id;

$sqlstatus = "UPDATE daftar_order SET status_tracking = '4' WHERE id_order='$id'";

if (mysqli_query($conn, $sqlstatus)) {
    echo "<script>
            alert('Order telah dibatalkan oleh admin!');
			</script>";
    header('location:../emailhapusorderadmin.php?delID=' . $id);
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
