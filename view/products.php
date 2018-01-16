<?php

$member_id = 0;
if((array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
    $member_id = $_SESSION["user"];
}
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {

                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (! empty($cartResult)) {
                    // Update cart item quantity in database
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Add to cart table
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
                }
            }
            break;
        case "remove":
            // Delete single entry from the cart
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Empty cart
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<script src="jquery-3.2.1.min.js"></script>
<script>
function increment_quantity(cart_id, price) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    var newQuantity = parseInt($(inputQuantityElement).val())+1;
    var newPrice = newQuantity * price;
    save_to_db(cart_id, newQuantity, newPrice);
}

function decrement_quantity(cart_id, price) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    if($(inputQuantityElement).val() > 1)
    {
    var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
    var newPrice = newQuantity * price;
    save_to_db(cart_id, newQuantity, newPrice);
    }
}

function save_to_db(cart_id, new_quantity, newPrice) {
	var inputQuantityElement = $("#input-quantity-"+cart_id);
	var priceElement = $("#cart-price-"+cart_id);
    $.ajax({
		url : "view/updateCartQuantity.php",
		data : "cart_id="+cart_id+"&new_quantity="+new_quantity,
		type : 'post',
		success : function(response) {
			$(inputQuantityElement).val(new_quantity);
            $(priceElement).text("$"+newPrice);
            var totalQuantity = 0;
            $("input[id*='input-quantity-']").each(function() {
                var cart_quantity = $(this).val();
                totalQuantity = parseInt(totalQuantity) + parseInt(cart_quantity);
            });
            $("#total-quantity").text(totalQuantity);
            var totalItemPrice = 0;
            $("div[id*='cart-price-']").each(function() {
                var cart_price = $(this).text().replace("$","");
                totalItemPrice = parseInt(totalItemPrice) + parseInt(cart_price);
            });
            $("#total-price").text(totalItemPrice);
		}
	});
}
</script>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
        }
    }
}
?>
<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping Cart</div>

            <a id="btnEmpty" href="index.php?action=emptyItemToShoppingCart"><img
                src="img/image/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity:<span id="total-quantity"> <?php echo $item_quantity; ?></div>
                <div>Total Price:<span id="total-price"> $ <?php echo $item_price; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once ("cart-list.php");
            ?>
            <div class="align-right">
            <a href="index.php?action=checkout"><button class="btn-action" name="check_out">Go To Checkout</button></a>
            </div>
<?php
        } // End if !empty $cartItem
        ?>

</div>
<?php
require_once "product-list.php";
?>
