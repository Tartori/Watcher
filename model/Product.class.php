<?php 
require_once 'autoloader.php';

class Product{
    public $id;
    public $name;
    public $code;
    public $image;
    public $price;
    private $db;
    
    function __construct(){
        $this->db = new DB();
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCode(){
        return $this->code;
    }
    public function getImage(){
        return $this->image;
    }
    public function getPrice(){
        return $this->price;
    }
    
    public function setName($name){
        $this->name=$name;
    }
    public function setCode($code){
        $this->code=$code;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setPrice($price){
        $this->price = $price;
    }

    public static function getAllProducts(){
        $instance = new self();
        return $instance->allProducts();
    }

    private function allProducts(){
        $query = "select * from tbl_product;";
        $result = $this->db->getDBResult($query);
        $products = array();
        if(is_array($result)){
            foreach($result as $row){
                $products[]=Product::fromDbRow($row);
            }
        }
        return $products;
    }

    static function getById($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }

    protected function loadById($id){
        $query = "select * from tbl_product where ID=?";
        $result = $this->db->getDBResult($query, array(array(
            "param_type" => "s",
            "param_value" => $id
        )));
        
        if(is_null($result)){
            throw new Exception("Unknown Product");
        }
        $this->loadFromDbRow($result[0]);
    }
    
    static function fromDbRow($row){
        $instance = new self();
        $instance->loadFromDbRow($row);
        return $instance;
    }

    function loadFromDbRow($row){
        $this->id=$row["id"];
        $this->setName($row["name"]);
        $this->setCode($row["code"]);
        $this->setImage($row["image"]);
        $this->setPrice($row["price"]);
    }

    static function create($name, $code, $img, $Price){
        $instance = new self();
        $instance->loadWithData($name, $code, $img, $Price);
        return $instance;
    }

    function loadWithData($name, $code, $img, $price){
        $this->setName($name);
        $this->setCode($code);
        $this->setImage($img);
        $this->setPrice($price);
        $this->saveToDb();
    }

    function delete(){
        $query="DELETE FROM `tbl_product` WHERE ID = ?";
            $params[]=  array(
                "param_type" => "s",
                "param_value" => $this->getId()
            );

        $this->db->updateDB($query, $params);
    }

    function saveToDb(){
        $query = "";
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $this->getName()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getCode()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getImage()
            ),array(
                "param_type" => "s",
                "param_value" => $this->getPrice()
            ));
        if(isset($this->id)){
            $query="UPDATE `tbl_product` SET ".
            "`name` = ?, `code` = ?, `image` = ?, `price` = ? WHERE ID = ?";
            $params[]=  array(
                "param_type" => "s",
                "param_value" => $this->getId()
            );

            $this->db->updateDB($query, $params);
        }
        else{
            $query = "INSERT INTO `tbl_product`" .
            "(`name`, `code`, `image`, `price`)".
            " VALUES (?, ?, ?, ?)";
            $id= $this->db->insertDB($query, $params);
            $this->id=$id;
        }
        
    }

}