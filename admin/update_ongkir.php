<?php
$conn = mysqli_connect("localhost", "root", "", "gakedai") or
    die('Could not connect to the database!');
mysqli_select_db($conn, "gakedai") or
    die('No database selected!');
if (!isset($_POST['update_ongkir'])) {
    header('location:index.php');
}
$id = $_POST['id_order'];
$nama_daerah = $_POST['nama_daerah'];
$tarif = $_POST['tarif'];

$sql = "UPDATE ongkir SET nama_daerah = '$nama_daerah', tarif = '$tarif' WHERE id_ongkir='$id'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Daerah ongkir telah diperbarui!');
            document.location.href = 'listOngkir.php';
			</script>";
} else {
    die('Unable to update record: ' . mysqli_error($conn));
}
