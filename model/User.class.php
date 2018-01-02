<?php 
class User {
	private $id;
	private $firstname;
    private $lastname;
    private $address;
    private $plz;
    private $city ;
    private $email ;
    private $cemail ;
    private $pw ;
    private $cpw ;

    private static $users = ['admin' => '123'];
	
	public static function checkCredentials($login, $pw) {
		return isset(self::$users[$login]) && self::$users[$login] == $pw;
	}
}
