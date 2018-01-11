<?php session_start(); ?>
<h1>
    <?php echo t("title"); ?>
</h1>

<?php

$produkte =array();
$SESS_fname = "warenkorb";

$verzeichnis = "img/";

$produkte = array(
                      array('Produkt' => "Casio",
                            'Preis' => "30 CHF",
                            'Beschreibung' => "Sehr cool",
                            'Bild' => "hoover.jpg") ,
                      array('Produkt' => "Marke",
                            'Preis' => "50 CHF",
                            'Beschreibung' => "ehr cool",
                            'Bild' => "loewen.jpg" ));

// Ausgabe der Bilderdateinamen zur Kontrolle
echo "<pre>";

echo "<hr>";

/*foreach($produkte as $inhalt){
      echo "<p>". $inhalt['Produkt'] .":". "</p></br>";
      echo "<p>". $inhalt["Preis"]. "</p></br>";
      echo "<p>". $inhalt["Beschreibung"]. "</p></br>";

      echo "<img src=$verzeichnis". $inhalt['Bild'] . ">";
}*/
?>
<div id="product-grid">
	<div class="txt-heading">Produkte</div>
	<?php
	//$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($produkte)) {
		foreach($produkte as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $produkte[$key]["Produkt"]; ?>">
			<div class="product-image"><img src="<?php echo  $verzeichnis . $produkte[$key]["Bild"]; ?>"></div>
			<div><strong><?php echo $produkte[$key]["Produkt"]; ?></strong></div>
			<div class="product-price"><?php echo "CHF ".$produkte[$key]["Preis"]; ?></div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
</div>
