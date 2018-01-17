<?php
	require_once 'autoloader.php';

$member_id = $_SESSION["user"]; // you can your integerate authentication module here to get logged in member

$shoppingCart = new ShoppingCart();
?>

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

            <a id="btnEmpty" href="index.php?action=empty"><img
                src="img/image/empty-cart.png" alt="empty-cart"
                title="<?php echo t("emptyCart"); ?> class="float-right" /></a>
            <div class="cart-status">
                <div><?php echo t("totalQuantity"); ?>:<span id="total-quantity"> <?php echo $item_quantity; ?></div>
                <div><?php echo t("totalPrice"); ?>:<span id="total-price"> $ <?php echo $item_price; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once ("cart-list.php");
            ?>
<?php
        } // End if !empty $cartItem
        ?>

</div>
    <form name="frm_customer_detail" action="index.php?action=processOrder" method="POST">
    <div class="frm-heading">
        <div class="txt-heading-label"><?php echo t("customerDetails"); ?></div>
    </div>
    <div class="frm-customer-detail">
        <div class="form-row">
            <div class="input-field">
                <input type="text" name="name" id="name"
                    PlaceHolder="<?php echo t("customerName"); ?>" value="<?php echo $data->getName(); ?>" required>
            </div>

            <div class="input-field">
                <input type="text" name="address" PlaceHolder="<?php echo t("address"); ?>" value="<?php echo $data->getAddressLine(); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-field">
                <input type="text" name="city" PlaceHolder="<?php echo t("city"); ?>" value="<?php echo $data->getCity(); ?>" required>
            </div>

            <div class="input-field">
                <input type="text" name="zip" PlaceHolder="<?php echo t("plz"); ?>" value="<?php echo $data->getPLZ(); ?>" required>
            </div>

        </div>
    </div>
    <div>
        <input type="submit" class="btn-action"
                name="proceed_payment" value="<?php echo t("proceedToPayment"); ?>">
    </div>
    </form>
