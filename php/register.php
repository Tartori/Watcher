<?php

require_once '../mailer/registerMailer.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$plz = $_POST['plz'];
$city = $_POST['city'];
$email = $_POST['email'];
$cemail = $_POST['cemail'];
$pw = $_POST['pw'];
$cpw = $_POST['cpw'];
echo("Hello $firstname $lastname address $address plz $plz city $city email $email c $cemail pw $pw c $cpw");

$mailer = new RegisterMailer("julianstampfli4@gmail.com", "Hello $firstname $lastname address $address plz $plz city $city email $email c $cemail pw $pw c $cpw");

if(!$mailer->sendMail()){
    echo "Mailer Error: " . $mailer->getExceptionDetails();
}else {
    echo "mail sent sucessfully";
}
    