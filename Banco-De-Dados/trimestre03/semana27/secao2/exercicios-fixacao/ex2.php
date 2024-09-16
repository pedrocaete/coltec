<?php

function fatorial($var)
{
    $resultado = 1;
    for($i = 2; $i <= $var; $i++){
        $resultado *= $i;
    }
    return $resultado;
}

echo fatorial(5);
?>
