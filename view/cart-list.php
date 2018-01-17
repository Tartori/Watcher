
<div class="shopping-cart-table">
        <div class="cart-item-container header">
            <div class="cart-info title">Title</div>
            <div class="cart-info">Quantity</div>
            <div class="cart-info price">Price</div>
        </div>
<?php
            foreach ($cartItem as $item) {
                ?>
				<div class="cart-item-container">
            <div class="cart-info title">
                <img class="cart-image"
                    src="img/<?php echo $item["image"]; ?>">
                    <?php echo $item["name"]; ?>
                </div>

            <!-- <div class="cart-info">
                     echo $item["quantity"]; ?>
                    </div> -->

                    <div class="cart-info quantity">
                        <div class="btn-increment-decrement" onClick="decrement_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">-</div><input class="input-quantity"
                            id="input-quantity-<?php echo $item["cart_id"]; ?>" value="<?php echo $item["quantity"]; ?>"><div class="btn-increment-decrement"
                            onClick="increment_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">+</div>
                    </div>

                    <div class="cart-info price" id="cart-price-<?php echo $item["cart_id"]; ?>">
                            <?php echo "$". ($item["price"] * $item["quantity"]); ?>
                        </div>

            <!-- <div class="cart-info price">
                       echo "$".$item["price"]; ?>
                    </div> -->


            <div class="cart-info action">
                <a
                    href="index.php?controller=home&action=removeItemToShoppingCart&id=<?php echo $item["cart_id"]; ?>"
                    class="btnRemoveAction"><img
                    src="img/image/icon-delete.png" alt="icon-delete"
                    title="Remove Item" /></a>
            </div>
        </div>
				<?php
            }
            ?>
</div>
