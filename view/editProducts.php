<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Code</th>
        <th>Image</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach($data as $product){
            echo "<tr>";
            echo "<td>".$product->getId()."</td>";
            echo "<td>".$product->getName()."</td>";
            echo "<td>".$product->getCode()."</td>";
            echo "<td>".$product->getImage()."</td>";
            echo "<td>".$product->getPrice()."</td>";
            echo "<td><a href='index.php?controller=admin&action=editProductView&id=".$product->getId()."'>edit<a/></td>";
            echo "<td><a href='index.php?controller=admin&action=deleteProduct&id=".$product->getId()."'>delete<a/></td>";
            echo "</tr>";
        }
    ?>
</table>
<a href='index.php?controller=admin&action=addProductView'>add<a/>
