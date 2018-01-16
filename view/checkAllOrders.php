<table>
    <tr>
        <th>Id</th>
        <th>CustomerID</th>
        <th>Amount</th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>PLZ</th>
        <th>Payment Type</th>
        <th>Status</th>
        <th>Date</th>
        <th>Detail</th>
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
            echo "<td><a href='index.php?controller=admin&action=orderDetail&id=".$order["id"]."'>detail<a/></td>";
            echo "</tr>";
        }
    ?>
</table>
