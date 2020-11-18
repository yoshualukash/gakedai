<?php
session_start();
unset($_SESSION['keranjang']);
echo "<script>location='menu.php#listmenu';</script>";
