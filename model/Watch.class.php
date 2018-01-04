<?php 
require_once '../autoloader.php';

class Watch{
    private $id;
    private $name;
    private $description;
    private $img;
    private $sizes;
    private $colors;

    public function getId(){
        return $this->$id;
    }
    public function getName(){
        return $this->$name;
    }
    public function getDescription(){
        return $this->$description;
    }
    public function getImg(){
        return $this->$img;
    }
    public function getSizes(){
        return array_keys($this->$sizes);
    }
    public function getColors(){
        return array_keys($this->$colors);
    }

    public function setId($id){
        $this->$id = $id;
    }
    public function setName($name){
        $this->$name=$name;
    }
    public function setDescription($description){
        $this->$description=$description;
    }
    public function setImg($img){
        $this->$img = $img;
    }
}