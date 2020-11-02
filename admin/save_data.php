<?php
$nama = $_POST['addnama'];
$username = $_POST['addusername'];
$password = $_POST['addpassword'];
$password = password_hash($password, PASSWORD_DEFAULT);
$role = $_POST['addrole'];

include('connection.php');

$sql = "INSERT INTO account_admin VALUES(NULL, '$nama', '$username', '$password', '$role')";

if (mysqli_query($conn, $sql)) {
    header('location:list_accAdmin.php');
} else {
    die('Unable to insert data:' . mysqli_error($conn));
}
