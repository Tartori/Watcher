<?php
require_once "mailer.php";

class OrderMailer extends Mailer{
    private $receiver;
	private $template;

	function __construct($receiver, $orderNumber, $price) {
		parent::__construct();
		$this->receiver = $receiver;
        $this->template = $this->load_mail_template("templates/orderTemplate.php", ['price' => $price, 'orderNumber'=>$orderNumber]);
	}

	function sendMail(){
		return parent::send("Order recieved.", $this->template, $this->receiver);
	}
}