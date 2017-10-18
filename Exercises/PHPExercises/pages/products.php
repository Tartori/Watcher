<h1>
    <?php echo t("title"); ?>
</h1>

<?php 
    $products = ["Auto", "Velo", "Bike"];
    foreach($products as $product) {
        echo "<div>$product</div><br />";
    }
?>