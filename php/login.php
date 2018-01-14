<?php
require_once '../autoloader.php';

$email = $_POST['email'];
$pw = $_POST['pw'];

$user = User::login($email, $pw);

echo($user->__toString());
