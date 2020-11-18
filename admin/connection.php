<?php
include('../dbconfig.php');
$conn = mysqli_connect("localhost", $dbuser, $dbpw, $dbdatabase) or
    die('Could not connect to the database!');


mysqli_select_db($conn, $dbdatabase) or
    die('No database selected!');
