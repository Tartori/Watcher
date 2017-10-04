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
		<?php include('php/navigation.php'); ?>
		<section class="column col-4">
			<h2>3-Columns Layout with Header and Footer</h2>
			<p>Eeuismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exercitation ulliam corper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p> 
			<p>Duis autem veleum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel willum lunombro dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim.</p> 
		</section>
		<!-- <aside class="column col-1">
			<h2>Info</h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exercitation ulliam corper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
		</aside> -->
	</div>
	<?php include('php/footer.php'); ?>
</body>
</html>