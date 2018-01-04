<?php 
require_once '../autoloader.php';

class User {
	private $id;
	private $firstname;
    private $lastname;
    private $addressLine;
    private $plz;
    private $city;
    private $email;
    private $pw;
    private $activated;

    public function getId() {
		return $this->id;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function getLastname() {
		return $this->lastname;
    }
    public function getName() {
		return $this->firstname . " " . $this->lastname;
	}
    public function getAddressLine() {
		return $this->addressLine;
    }
    public function getPlz() {
		return $this->plz;
    }
    public function getCity() {
		return $this->city;
    }
    public function getAddress(){
        return $this->addressLine . ", " . $this->plz . " " . $this->city;
    }
    public function getEmail() {
		return $this->email;
    }
    public function getActivated(){
        return $this->activated;
    }

    public function __toString(){
		return sprintf("%s, %s, %s", $this->getName(), $this->getAddress(), $this->getEmail());
    }
    
    public function setId($id){
        $this->id=$id;
    }
    public function setFirstname($firstname){
        $this->firstname=$firstname;
    }
    public function setLastname($lastname){
        $this->lastname=$lastname;
    }
    public function setAddressLine($addressLine){
        $this->addressLine=$addressLine;
    }
    public function setPLZ($plz){
        $this->plz=$plz;
    }
    public function setCity($city){
        $this->city=$city;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setPassword($pw){
        $this->pw=$pw;
    }
    public function setActivated($activated){
        $this->activated=$activated;
    }
}