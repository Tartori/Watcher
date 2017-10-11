<?php
    require("lib/helpers.php")
?>
<!DOCTYPE html>
<html><head> 
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="Style\style.css" />
</head>
<body>
	<nav><span>Navigation</span>
		<?php navigation($language, $pageId); ?>
		<div><?php languages($language, $pageId); ?></div>
	</nav>
	<main>
		<span>Main Area</span>
        <?php 
        $fn="pages/$pageId.php";
        if(is_file($fn)){
        include("pages/$pageId.php");
        }
        else{
            echo "under construction";
        } ?>
	</main>
</body>
</html>