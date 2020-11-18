<?php
session_start();
$id_produk = $_GET['id'];
if ($_SESSION['keranjang'][$id_produk] > 0) {
    $_SESSION['keranjang'][$id_produk] -= 1;
}
if ($_SESSION['keranjang'][$id_produk] == 0) {
    unset($_SESSION['keranjang'][$id_produk]);
}
echo "<script>location='menu.php#listmenu';</script>";
