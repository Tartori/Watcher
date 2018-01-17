<?php
require_once "mailer.php";

class RegisterMailer extends Mailer{
	private $receiver;
	private $template;

	function __construct($receiver) {
		parent::__construct();
		$this->receiver = $receiver;
		$this->template = $this->load_mail_template("templates/registerTemplate.php", ['activation_link' => $receiver->getActivationHash()]);
	}

	function sendMail(){
		return parent::send("Activate your Account", $this->template, $this->receiver->getEmail());
	}
}