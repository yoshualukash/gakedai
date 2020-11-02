<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM account_google WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header('location:list_accGoogle.php');
} else {
    die('Could not delete record:' . mysqli_error($conn));
}
