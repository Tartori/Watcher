<?php


$member_id = 0;
if((array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
    $member_id = $_SESSION["user"];
}
$shoppingCart = new ShoppingCart();

$shoppingCart->updateCartQuantity($_POST["new_quantity"], $_POST["cart_id"]);
?>
