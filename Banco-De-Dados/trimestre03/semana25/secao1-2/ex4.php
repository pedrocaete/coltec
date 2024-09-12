<?php

$string = "Aprender php é legal";
$numEspacos = substr_count($string, " ");
$a = "aula";
$b = "de";
$c = "php";
$abc = $a . $b . $c;
$select = 1;

switch ($select) {
case 1:
    echo $abc;
    echo "<br>Tamanho da String concatenada: " . strlen($abc);
    break;
case 2:
    echo "String: " . $string . "<br>";
    echo "O número de espaços é " . $numEspacos;
    break;
default:
    echo "Opção inválida";
    break;
}
