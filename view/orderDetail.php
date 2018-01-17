<table>
    <tr>
        <th><?php echo t("productId"); ?></th>
        <th><?php echo t("price"); ?></th>
        <th><?php echo t("quantity"); ?></th>
    </tr>
    <?php
        foreach($data as $order){
            echo "<tr>";
            echo "<td>".$order["product_id"]."</td>";
            echo "<td>".$order["item_price"]."</td>";
            echo "<td>".$order["quantity"]."</td>";
            echo "</tr>";
        }
    ?>
</table>
<a href='index.php?controller=admin&action=checkAllOrders'><?php echo t("back"); ?><a/>