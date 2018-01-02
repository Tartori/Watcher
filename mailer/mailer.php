<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

abstract class Mailer{
    private $mail;
    
    function __construct(){
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "watcher.shop@gmail.com";
        $this->mail->Password = "8-VFVRYsind8jsp6nrg-";
    }

    protected function send($subject = "", $body = "", $receiver = "", $recieverAlias = ""){
        echo "<br />Subject $subject <br />";
        echo "<br />Body ". htmlspecialchars($body) . "< br />";
        echo "<br />Reciever $receiver<br />";
        $this->mail->setFrom('watcher.shop@gmail.com', 'Watcher Shop');
        $this->mail->addReplyTo('watcher.shop@gmail.com', 'Watcher Shop');
        $this->mail->addAddress($receiver, $recieverAlias);
        $this->mail->Subject = $subject;
        $this->mail->msgHTML($body, __DIR__);
        return $this->mail->send();        
    }

    protected function load_mail_template($template_path, array $options = []){
		$template = file_get_contents(__DIR__ . "/" . $template_path);
		foreach($options as $key => $value){
			$regex = '/<%\s*\'' . $key . '\'\s*%>/i';
			$template = preg_replace($regex, $value, $template);
		}
		return $template;
	}

    abstract function sendMail();

    public function getExceptionDetails(){
        return $this->mail->ErrorInfo;
    }
}