<?php
session_start();
include("connection.php");
include("input_menu.php");
if (!isset($_SESSION['password'])) {
  header('location:login.php');
} else if (isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
  $nama_admin = $_SESSION['nama_admin'];
}
$sqladmin = "SELECT * FROM account_admin WHERE username = '$username'";
$resultadmin = mysqli_query($conn, $sqladmin);
$rowadmin = mysqli_fetch_array($resultadmin);
