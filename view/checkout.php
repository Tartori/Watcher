<?php
	require_once 'autoloader.php';

$member_id = $_SESSION["user"]; // you can your integerate authentication module here to get logged in member

$shoppingCart = new ShoppingCart();
?>
<HTML>
<HEAD>
<TITLE>Enriched Responsive Shopping Cart in PHP</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
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
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity: <?php echo $item_quantity; ?></div>
                <div>Total Price: $ <?php echo $item_price; ?></div>
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
        <div class="txt-heading-label">Customer Details</div>
    </div>
    <div class="frm-customer-detail">
        <div class="form-row">
            <div class="input-field">
                <input type="text" name="name" id="name"
                    PlaceHolder="Customer Name" value="<?php echo $data->getName(); ?>" required>
            </div>

            <div class="input-field">
                <input type="text" name="address" PlaceHolder="Address" value="<?php echo $data->getAddressLine(); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-field">
                <input type="text" name="city" PlaceHolder="City" value="<?php echo $data->getCity(); ?>" required>
            </div>

            <div class="input-field">
                <input type="text" name="zip" PlaceHolder="Zip Code" value="<?php echo $data->getPLZ(); ?>" required>
            </div>

        </div>
    </div>
    <div>
        <input type="submit" class="btn-action"
                name="proceed_payment" value="Proceed to Payment">
    </div>
    </form>
</BODY>
</HTML>