<?php 
    if(isset($data)&&sizeof($data)>0){
        $product = $data[0];
    }
?>

<h1> Please enter the information for the product</h1>

<form action="index.php?controller=admin&action=saveProduct" method="post">
    <input id="id" name="id" value="<?php echo isset($product)?$product->getId():"0"; ?>" type="hidden" />
    <p><label for="na">Name: </label><input id="na" name="name" value="<?php echo isset($product)?$product->getName():""; ?>" required/></p>
    <p><label for="co">Code: </label><input id="co" name="code" value="<?php echo isset($product)?$product->getCode():""; ?>" required/></p>
    <p><label for="img">Image: </label><input id="img" name="img" value="<?php echo isset($product)?$product->getImage():""; ?>" required/></p>
    <p><label for="pr">Price: </label><input id="pr" name="price" value="<?php echo isset($product)?$product->getPrice():""; ?>" pattern="^\d+.\d{0,2}$" required/></p>
    <p><input type="submit" /></p>
</form>
<a href='index.php?controller=admin&action=editProducts'>Cancel<a/>