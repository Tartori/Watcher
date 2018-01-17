<table>
    <tr>
        <th>Id</th>
        <th><?php echo t("name"); ?></th>
        <th><?php echo t("code"); ?></th>
        <th><?php echo t("img"); ?></th>
        <th><?php echo t("price"); ?></th>
        <th><?php echo t("edit"); ?></th>
        <th><?php echo t("delete"); ?></th>
    </tr>
    <?php
        foreach($data as $product){
            echo "<tr>";
            echo "<td>".$product->getId()."</td>";
            echo "<td>".$product->getName()."</td>";
            echo "<td>".$product->getCode()."</td>";
            echo "<td>".$product->getImage()."</td>";
            echo "<td>".$product->getPrice()."</td>";
            echo "<td><a href='index.php?controller=admin&action=editProductView&id=".$product->getId()."'>".t("edit")."<a/></td>";
            echo "<td><a href='index.php?controller=admin&action=deleteProduct&id=".$product->getId()."'>".t("delete")."<a/></td>";
            echo "</tr>";
        }
    ?>
</table>
<a href='index.php?controller=admin&action=addProductView'><?php echo t("add"); ?><a/>
