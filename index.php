<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="Style\style.css" />
	<title>Layout Example</title>
</head>
<body>
	<header class="row"><h1>This is the header</h1></header>
    <section class="row">
        <h1> Discounts YAY!!</h1>
        <p> some description</p>
    </section>
	<div class="row">
		<?php include('navigation.php'); ?>
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
	<footer class="row">This is the footer</footer>
</body>
</html>