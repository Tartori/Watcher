<?php
    $x=12;
    echo gettype($x)."<br>\n";
    $x="Hello World";
    echo gettype($x)."<br>\n";
    //php is untyped but has types. we can convert stuff into another type. 
    $x=7;
    $y=5;
    $z=$x+$y;
    echo $z."<br>\n";
    echo $z."<br>\n";
    echo 6+"10"."<br>\n";
    echo (int)3.4;
    echo "<br>\n";

    echo isset($x);echo "<br>\n";
    echo isset($asd);echo "<br>\n";
    $x = "Hello World";
    echo strtolower($x);echo "<br>\n";
    echo strtoupper($x);echo "<br>\n";
    echo strlen($x);echo "<br>\n";
    echo strrev($x);echo "<br>\n";

    $z=12;
    $x="Hello World $z";
    echo $x;echo "<br>\n";
    $x='Hello World $z<br>\n';
    echo $x;echo "<br>\n";

    echo '<a href="..\index.php">home</a>';
    echo "<br>\n";
    
    $x="Bob";
    $y=$x;
    $x="Alice";

    echo $x;
    echo "<br>\n";
    echo $y;
    echo "<br>\n";
    
    $x="Bob";
    $y=&$x;
    $x="Alice";

    echo $x;
    echo "<br>\n";
    echo $y;
    echo "<br>\n";
    
    $x="Bob";
    $$x="Alice";

    echo $x;
    echo "<br>\n";
    echo $$x;
    echo "<br>\n";
    echo $Bob;
    echo "<br>\n";

    echo __FILE__;
    echo "<br>\n";
    echo PHP_VERSION;
    echo "<br>\n";
    define("MY_CONST", "Hello World!");
    const MY_CONST2 = "Hello World!";
    
    echo MY_CONST2;
    echo "<br>\n";
    echo MY_CONST;
    echo "<br>\n";


    
?>