<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading-label"><?php echo t("products"); ?></div>
    </div>
    <?php
    $product_array = $shoppingCart->getAllProduct();
    if (! empty($product_array)) {
        foreach ($product_array as $product) {
            ?>
        <div class="product-item">
        <form method="post"
            action="index.php?lang=de&controller=home&action=addItemToShoppingCart&code=<?php echo $product->getCode(); ?>">
            <div class="product-image">
                <img src="img/<?php echo $product->getImage(); ?>">
                <div class="product-title">
                    <?php echo $product->getName();; ?>
                </div>
            </div>
            <div class="product-footer">
                <div class="float-right">
                    <input type="text" name="quantity" value="1"
                        size="2" class="input-cart-quantity" /><input type="image"
                        src="img/image/add-to-cart.png" class="btnAddAction" />
                </div>
                <div class="product-price float-left"><?php echo "$".$product->getPrice(); ?></div>

            </div>
        </form>
    </div>
    <?php
        }
    }
    ?>
</div>
