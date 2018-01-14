<?php

require_once '../mailer/registerMailer.php';
require_once '../autoloader.php';

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$plz = $_POST['plz'];
$city = $_POST['city'];
$email = $_POST['email'];
$cemail = $_POST['cemail'];
$pw = $_POST['pw'];
$cpw = $_POST['cpw'];

$user = User::create($username, $firstname, $lastname, $address, $plz, $city, $email, $pw);


echo($user->__toString());

$mailer = new RegisterMailer("julianstampfli4@gmail.com", $user->__toString());

if(!$mailer->sendMail()){
    echo "Mailer Error: " . $mailer->getExceptionDetails();
}else {
    echo "mail sent sucessfully";
}
    