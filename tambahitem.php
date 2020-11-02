<?php
session_start();
$id_produk = $_GET['id'];
$_SESSION['keranjang'][$id_produk] += 1;

echo "<script>location='menu.php';</script>";
