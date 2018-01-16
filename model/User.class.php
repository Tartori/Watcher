<?php 
require_once 'autoloader.php';

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
    private $activationHash;
    private $isAdmin;
    private $db;
    
    function __construct(){
        $this->db = new DB();
    }

    static function create($firstname, $lastname, $addressLine, $plz, $city, $email, $pw){
        $instance = new self();
        $users = $instance->allUser();
        foreach($users as $user){
            if($user->getEmail()==$email){
                throw new Exception("Email already exists.");
            }
        }
        $instance->loadWithData($firstname, $lastname, $addressLine, $plz, $city, $email, $pw);
        return $instance;
    }
    
    static function login($mail, $pw){
        $instance = new self();
        $instance->loadWithLogin($mail, $pw);
        return $instance;
    }
    
    static function activate($code){
        $instance = new self();
        $instance->loadActivation($code);
        return $instance;
    }

    static function fromDbRow($row){
        $instance = new self();
        $instance->loadFromDbRow($row);
        return $instance;
    }

    static function getAllUser(){
        $instance = new self();
        return $instance.allUser();
    }

    protected function loadActivation($code){
        $this->setActivationHash($code);
        $query = "select * from user where ActivationHash=?";
        $result = $this->db->getDBResult($query, array(array(
            "param_type" => "s",
            "param_value" => $this->getEmail()
        )));        if(is_null($result)){
            throw new Exception("Invalid or already used Activation Hash");
        }
        $this->loadFromDbRow($result[0]);
        $this->setActivated(true);
        $this->setActivationHash("");
        $this->saveToDb();
    }

    protected function loadWithLogin($mail, $pw){
        $this->setEmail($mail);
        $query = "select * from user where email=?";
        $result = $this->db->getDBResult($query, array(array(
            "param_type" => "s",
            "param_value" => $this->getEmail()
        )));
        if(is_null($result)){
            throw new Exception("Invalid Password or Email");
        }
        if(password_verify($pw, $result[0]["Password"])){
            $this->loadFromDbRow($result[0]);
        } else{            
            throw new Exception("Invalid Password or Email");
        }
    }

    function loadFromDbRow($row){
        $this->id=$row["ID"];
        $this->setPasswordHash($row["Password"]);
        $this->setFirstname($row["Firstname"]);
        $this->setLastname($row["Lastname"]);
        $this->setAddressLine($row["AddressLine"]);
        $this->setPLZ($row["PLZ"]);
        $this->setCity($row["City"]);
        $this->setEmail($row["Email"]);
        $this->setActivationHash($row["ActivationHash"]);
        $this->setActivated($row["Activated"]==="1");
        $this->setIsAdmin($row["IsAdmin"]==="1");
    }

    function loadWithData($firstname, $lastname, $addressLine, $plz, $city, $email, $pw){
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setAddressLine($addressLine);
        $this->setPlz($plz);
        $this->setCity($city);
        $this->setEmail($email);
        $this->setPassword($pw);
        $this->setActivationHash(sha1(mt_rand(10000,99999).time().$email));
        $this->setActivated(false);
        $this->setIsAdmin(false);
        $this->saveToDb();
    }

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
    public function getPassword(){
        return $this->pw;
    }
    public function getActivated(){
        return $this->activated;
    }
    public function getActivationHash(){
        return $this->activationHash;
    }
    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function __toString(){
		return sprintf("%s, %s, %s", $this->getName(), $this->getAddress(), $this->getEmail());
    }
    
    public function setId($id){
        $this->id=$id;
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
        $this->setPasswordHash(password_hash($pw, PASSWORD_BCRYPT));
    }
    private function setPasswordHash($pw){
        $this->pw=$pw;
    }
    public function setActivated($activated){
        $this->activated=$activated===true;
    }
    public function setActivationHash($hash){
        $this->activationHash=$this->db->escapeString($hash);
    }
    public function setIsAdmin($isAdmin){
        $this->isAdmin=$isAdmin===true;
    }

    private function allUser(){
        $query = "select * from user;";
        $result = $this->db->getDBResult($query);
        $users = array();
        foreach($result as $row){
            $users[]=User::fromDbRow($row);
        }
        return $users;
    }

    public function saveToDb(){
        $query = "";
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $this->getFirstname()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getLastname()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getAddressLine()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getPlz()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getCity()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getEmail()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getPassword()
            ),array(
                "param_type" => "s",
                "param_value" => $this->activated===true?1:0
            ),array(
                "param_type" => "s",
                "param_value" => $this->getActivationHash()
            ),array(
                "param_type" => "s",
                "param_value" => $this->isAdmin===true?1:0
            )
          );
        if(isset($this->id)){
            $query="UPDATE `user` SET ".
            "`Firstname` = ?, `Lastname` = ?, `AddressLine` = ?, `PLZ` = ?,".
            " `City` = ?, `Email` = ?, `Password` = ?, `Activated` = ?, `ActivationHash` = ?,".
            " `IsAdmin` = ? WHERE ID = ?";
            $params[]=  array(
                "param_type" => "s",
                "param_value" => $this->getId()
            );

            $this->db->updateDB($query, $params);
        }
        else{
            $query = "INSERT INTO `user`" .
            "(`Firstname`, `Lastname`, `AddressLine`, `PLZ`, `City`," .
            " `Email`, `Password`, `Activated`, `ActivationHash`, `IsAdmin`)".
            " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $id= $this->db->insertDB($query, $params);
            $this->id=$id;
        }
    }
}