<?php
require_once 'autoloader.php';

abstract class Controller {
	protected $params;
	protected $data = [];
	protected $title;
	protected $message;

	public function __construct() {
	}

	protected function flash($message){
		if(!isset($_SESSION['flash'])) $_SESSION['flash'] = [];
		array_push($_SESSION['flash'], $message);
	}

	/**
	 * @return array of methods that do not require login
	 */
	public function doNotRequireLogin() {
		return [];
	}

	public function index(Request $request) {
		return "Not implemented";
	}

	public function edit(Request $request) {
		return "Not implemented";
	}

	//NOTE new is a stupid keyword...
	public function newly(Request $request) {
		return "Not implemented";
	}

	public function create(Request $request) {
		return "Not implemented";
	}

	public function delete(Request $request) {
		return "Not implemented";
	}

	public function update(Request $request) {
		return "Not implemented";
	}

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