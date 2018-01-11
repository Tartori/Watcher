
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
			if(is_file($innerTpl)){
			include($innerTpl);
			}
			else{
				echo "under construction";
			} ?>	
	</div>
	<?php include('php/footer.php'); ?>
</body>
</html>