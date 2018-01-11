<?php
	require("lib/helpers.php");
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
		if(in_array($action, $controller->doNotRequireLogin())) {
			$controller->$action($request);
		}
	}else{
		echo "page not found.";
		die;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="Style\style.css" />
	<title>Layout Example</title>
</head>
<body>
	<?php include('php/header.php'); ?>
	<?php include('php/wheel.php'); ?>	
	<div class="row">
		<nav class="column col-1">
			<?php navigation($language, $pageId); ?>
			<div><?php languages($language, $pageId); ?></div>
		</nav>
		<section class="column col-4">
			<?php 
			$fn="view/$pageId.php";
			if(is_file($fn)){
			include("view/$pageId.php");
			}
			else{
				echo "under construction";
			} ?>	
	</div>
	<?php include('php/footer.php'); ?>
</body>
</html>