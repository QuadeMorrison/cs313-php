<?php
session_start();
session_unset();

$content = file_get_contents('loginPage.php');
echo eval(' ?>'. $content);
?>