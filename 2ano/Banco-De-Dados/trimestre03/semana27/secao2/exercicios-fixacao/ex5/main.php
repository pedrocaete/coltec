<?php
include 'raizesEquacaoSegundoGrau.php';

$raizes = raizesEquacaoSegundoGrau(3,10,1);

foreach ($raizes as $a){
    echo $a . "<br>";
}
