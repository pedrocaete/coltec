<?php

$matrizA = array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 9)
);
$matrizB = array(
    array(1, 0, 0),
    array(0, 1, 1),
    array(1, 0, 1)
);

$resultado = array(
    array(0, 0, 0),
    array(0, 0, 0),
    array(0, 0, 0)
);

for ($i = 0; $i < 3; $i ++){
    for ($j = 0; $j < 3; $j ++){
        $resultado[$i][$j] = 0;
        for($k = 0; $k < 3; $k ++){
            $resultado[$i][$j] = $matrizA[$i][$k] * $matrizB[$k][$j];
        }
    }
}

for ($i = 0; $i < 3; $i ++){
    for ($j = 0; $j < 3; $j ++){
        echo $resultado[$i][$j] . " ";
    }
    echo "<br>";
}
