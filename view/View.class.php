<?php

class View {

	private $controller;

	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}

	public function render($tpl) {
		$innerTpl = __DIR__ ."/$tpl.php";
		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		$message = $this->controller->getMessage();
		$ct = $this->controller->getTitle();
		$title = "Watcher" . ($ct ? " - ".$ct : "");
		$data = $this->controller->getData();
		include  __DIR__ ."/main.php";
	}
}
