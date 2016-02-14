<?php
require_once "config.php";
$email = $_POST['email'];
$password = $_POST['password'];
$password_conf = $_POST['password_conf'];

$db = loadDatabase();
$queryString = "SELECT id FROM user WHERE email=?";
$emailQuery = $db->prepare($queryString);
$emailQuery->execute(array($email));
$numRows = $emailQuery->rowCount();

if ($numRows > 0) {
    echo "That email address is already in use";
} else if (preg_match('/^[\w-]+@[\w]+.(com|edu|gob|net|org|io|me|ca|co)$/', $email) == 0) {
    echo "Your email isn't valid (accepted format example@example.com)";
} else if ($password != $password_conf) {
    echo "Your passwords do not match";
} else if (strlen($password) < 6) {
    echo "Your password must be atleast 6 characters";
} else {
    $queryString = "INSERT INTO user(email, password) VALUES(:email, :password)";
    $signUp = $db->prepare($queryString);
    $signUp->execute(array(':email' => $email, ':password' => $password));
    echo "Success";
}
?>