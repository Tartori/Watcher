<?php
require_once 'autoloader.php';

abstract class Controller {
	protected $params;
	protected $data = [];
	protected $title;
	protected $message;

	public function getMessage(){
		return $this->message;
	}

    public function getData(){
		return $this->data;
    }

    public function getTitle(){
        return $this->title;
    }
}