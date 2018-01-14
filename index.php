<?php
	require_once "lib/helpers.php";
	require_once 'autoloader.php';
	$request = new Request();

	$controllers = [
		'home' 			=> 'HomeController',
		'admin' 		=> 'AdminController'
	];

	$action = $request->getParameter('action', 'index');
	$controller = $controllers[$request->getParameter('controller', 'home')];
	$controller = new $controller();
	
	if(!is_null($controller)){
		//if(in_array($action, $controller->doNotRequireLogin())) {
			$tpl = $controller->$action($request);
			$tpl = $tpl ? $tpl : $action;

			// Create view
			$view = new View($controller);
			$view->render($tpl);
		//}
	}else{
		echo "page not found.";
		die;
	}