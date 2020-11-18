<?php
include('dbconfig.php');
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', $dbuser);
define('DB_PASSWORD', $dbpw);
define('DB_NAME', $dbdatabase);
define('DB_USER_TBL', 'account_google');

// Google API configuration
define('GOOGLE_CLIENT_ID', '920021076737-ksu57o3fihfhrnkhvfgjmcnhirn2gue2.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '9Aw-sD6L4N58CNmtB_HeW3jT');
define('GOOGLE_REDIRECT_URL', 'http://localhost/gakedai/login.php');

if (!isset($_SESSION)) {
    session_start();
}
require_once "vendor/autoload.php";
$google_client = new Google_Client();
$google_client->setApplicationName('Login to GAKedai');
$google_client->setClientId(GOOGLE_CLIENT_ID);
$google_client->setClientSecret(GOOGLE_CLIENT_SECRET);
$google_client->setRedirectUri(GOOGLE_REDIRECT_URL);
$google_client->addScope('email');
$google_client->addScope('profile');

//Create Object of Google Service OAuth 2 class
$google_service = new Google_Service_Oauth2($google_client);
