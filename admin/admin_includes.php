<?php
session_start();
include("connection.php");
if (isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
}
if (!isset($_SESSION['password'])) {
  header('location:login.php');
} else if (isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
}
$sqladmin = "SELECT * FROM account_admin WHERE username = '$username'";
$resultadmin = mysqli_query($conn, $sqladmin);
$rowadmin = mysqli_fetch_array($resultadmin);
