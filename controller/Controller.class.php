<?php

abstract class Controller {
	protected $params;

	public function __construct() {
		$this->parse_params();
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

	public function index() {
		return "Not implemented";
	}

	public function edit() {
		return "Not implemented";
	}

	//NOTE new is a stupid keyword...
	public function newly() {
		return "Not implemented";
	}

	public function create() {
		return "Not implemented";
	}

	public function delete() {
		return "Not implemented";
	}

	public function update() {
		return "Not implemented";
	}

	
}