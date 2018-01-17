<h1><?php echo t("orderInfo"); ?></h1>

<table>
    <tr>
        <th>Id</th>
        <th><?php echo t("customerId");?></th>
        <th><?php echo t("price");?></th>
        <th><?php echo t("name");?></th>
        <th><?php echo t("address");?></th>
        <th><?php echo t("city");?></th>
        <th><?php echo t("plz");?></th>
        <th><?php echo t("paymentType");?></th>
        <th><?php echo t("status");?></th>
        <th><?php echo t("date");?></th>
        <th><?php echo t("detail");?></th>
    </tr>
    <?php
        foreach($data as $order){
            echo "<tr>";
            echo "<td>".$order["id"]."</td>";
            echo "<td>".$order["customer_id"]."</td>";
            echo "<td>".$order["amount"]."</td>";
            echo "<td>".$order["name"]."</td>";
            echo "<td>".$order["address"]."</td>";
            echo "<td>".$order["city"]."</td>";
            echo "<td>".$order["zip"]."</td>";
            echo "<td>".$order["payment_type"]."</td>";
            echo "<td>".$order["order_status"]."</td>";
            echo "<td>".$order["order_at"]."</td>";
            echo "<td><a href='index.php?controller=admin&action=orderDetail&id=".$order["id"]."'>".t("detail")."<a/></td>";
            echo "</tr>";
        }
    ?>
</table>
