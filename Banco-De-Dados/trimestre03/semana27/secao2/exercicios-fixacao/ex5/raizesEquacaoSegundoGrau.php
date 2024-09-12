<?php

function raizesEquacaoSegundoGrau($a, $b, $c){
    $bhaskara = pow($b, 2) - 4 * $a * $c;
    $raiz1 = (-$b - sqrt($bhaskara))/ (2 * $a);
    $raiz2 = (-$b + sqrt($bhaskara))/ (2 * $a);
    return array($raiz1, $raiz2);
}
?>
