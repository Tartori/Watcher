<h1>
    <?php echo t("title"); ?>
</h1>

<?php

$bilderdateinamen =array();

$verzeichnis = "../img";

$bilderdateinamen = array(array('Produkt' => "Casio",
                          'Preis' => "30 CHF",
                          'Beschreibung' => "Sehr cool",
                          'Bild' => "img/hoover.jpg") ,array('Produkt' => "Marke",
                          'Preis' => "50 CHF",
                          'Beschreibung' => "ehr cool",
                          'Bild' => "img/loewen.jpg" ));

// Ausgabe der Bilderdateinamen zur Kontrolle
echo "<pre>";

echo "<hr>";
var_dump($bilderdateinamen);

foreach($bilderdateinamen as $inhalt){
      echo "<p>". $inhalt['Produkt'] .":". "</p></br>";
      echo "<p>". $inhalt["Preis"]. "</p></br>";
      echo "<p>". $inhalt["Beschreibung"]. "</p></br>";

      echo "<img src=". $inhalt['Bild'] . ">";
}
