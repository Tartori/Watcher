<?php
require_once '../autoloader.php';

$email = $_POST['email'];
$pw = $_POST['pw'];

$user = new User($email, $pw);

echo($user->__toString());
