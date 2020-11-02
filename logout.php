<?php

//Include GP config file
require_once 'config.php';

//Unset token and user data from session
unset($_SESSION['token']);

//Reset OAuth access token
$google_client->revokeToken();

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: index.php");
