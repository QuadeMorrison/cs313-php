<?php
session_start();
session_unset(); // unset user variable

$content = file_get_contents('loginPage.php'); // take user to login page
echo eval(' ?>'. $content); // return log in page to client
?>