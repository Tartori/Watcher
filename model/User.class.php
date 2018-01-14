<?php 
require_once '../autoloader.php';

class User {
    private $id;
    private $username;
    private $firstname;
    private $lastname;
    private $addressLine;
    private $plz;
    private $city;
    private $email;
    private $pw;
    private $activated;
    private $activationHash;
    private $salt;
    private $db;
    
    function __construct(){
        $this->db = new DB();
    }

    static function create($username, $firstname, $lastname, $addressLine, $plz, $city, $email, $pw){
        $instance = new self();
        $instance->loadWithData($username, $firstname, $lastname, $addressLine, $plz, $city, $email, $pw);
        return $instance;
    }
    
    static function login($mail, $pw){
        $instance = new self();
        $instance->loadWithLogin($mail, $pw);
        return $instance;
    }



    protected function loadWithLogin($mail, $pw){
        $this->setEmail($mail);
        $query = "select * from user where email='".$this->getEmail()."'";
        $result = $this->db->runQuery($query);
        if(password_verify($pw, $result[0]["Password"])){
            $this->loadFromDbRow($result[0]);
        } else{
            throw new Exception("Invalid Password");
        }
    }

    function loadFromDbRow($row){

    }

    function loadWithData($username, $firstname, $lastname, $addressLine, $plz, $city, $email, $pw){
        $this->setUsername($username);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setAddressLine($addressLine);
        $this->setPlz($plz);
        $this->setCity($city);
        $this->setEmail($email);
        $this->setPassword($pw);
        $this->setActivationHash("");
        $this->setSalt("");
        $this->setActivated(true);
        $this->saveToDb();
    }

    public function getId() {
		return $this->id;
	}
	public function getUsername() {
		return $this->username;
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
    public function getPassword(){
        return $this->pw;
    }
    public function getActivated(){
        return $this->activated;
    }
    public function getActivationHash(){
        return $this->activationHash;
    }
    public function getSalt(){
        return $this->salt;
    }

    public function __toString(){
		return sprintf("%s - %s, %s, %s", $this->getUsername(), $this->getName(), $this->getAddress(), $this->getEmail());
    }
    
    public function setId($id){
        $this->id=$id;
    }
    public function setUsername($un){
        $username = $this->db->escapeString($un);
        $this->username = $username;
    }
    public function setFirstname($firstname){
        $this->firstname=$this->db->escapeString($firstname);
    }
    public function setLastname($lastname){
        $this->lastname=$this->db->escapeString($lastname);
    }
    public function setAddressLine($addressLine){
        $this->addressLine=$this->db->escapeString($addressLine);
    }
    public function setPLZ($plz){
        $this->plz=$this->db->escapeString($plz);
    }
    public function setCity($city){
        $this->city=$this->db->escapeString($city);
    }
    public function setEmail($email){
        $this->email=$this->db->escapeString($email);
    }
    public function setPassword($pw){
        $this->pw=password_hash($this->db->escapeString($pw), PASSWORD_BCRYPT);
    }
    public function setActivated($activated){
        $this->activated=$this->db->escapeString($activated);
    }
    public function setActivationHash($hash){
        $this->activationHash=$this->db->escapeString($hash);
    }
    public function setSalt($hash){
        $this->salt=$this->db->escapeString($salt);
    }

    public function saveToDb(){
        $query = "INSERT INTO `user`" .
        "(`Username`, `Firstname`, `Lastname`, `AddressLine`, `PLZ`, `City`," .
        " `Email`, `Password`, `Activated`, `ActivationHash`, `Salt`)".
        " VALUES " .       
        "('". $this->getUsername() ."', ".
        " '". $this->getFirstname() ."',".
        " '". $this->getLastname() ."',".
        " '". $this->getAddressLine() ."',".
        " '". $this->getPlz() ."',".
        " '". $this->getCity() ."',".
        " '". $this->getEmail() ."',".
        " '". $this->getPassword() ."', ".
        " ". "1" .",".
        " '". $this->getActivationHash() ."',".
        " '". $this->getSalt() ."');";
        var_dump($query);
        
        $this->db->runStatement($query);
    }
}