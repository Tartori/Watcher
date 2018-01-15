<?php
spl_autoload_register(function($class_name){
	
	// Directories to look in
	$dirs = [
		'lib/',
		'controller/',
		'model/',
		'mailer/',
		'view/'
	];
	
	// Try to load class
	foreach($dirs as $dir) {
		$file = __DIR__."/$dir$class_name.class.php";
		if(file_exists($file)) {
			require_once($file);
			break;
		}
	}
});
