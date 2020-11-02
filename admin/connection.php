<?php

$conn = mysqli_connect("localhost", "root", "", "gakedai") or
    die('Could not connect to the database!');


mysqli_select_db($conn, "gakedai") or
    die('No database selected!');
