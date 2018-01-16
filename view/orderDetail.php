<table>
    <tr>
        <th>Product Id</th>
        <th>Price</th>
        <th>Quantity</th>
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
<a href='index.php?controller=admin&action=checkAllOrders'>back<a/>