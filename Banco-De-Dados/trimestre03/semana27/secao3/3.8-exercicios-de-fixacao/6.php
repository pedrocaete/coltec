<?php
$url = "http://newton.coltec.ufmg.br/fantini/php/teste1.php";
$webPage = file_get_contents($url);

if ($webPage) {
    $lines = explode("\n", $webPage);
    foreach ($lines as $numLine => $line) {
        echo "Line #<b>{$numLine}</b> : " . htmlspecialchars($line) . "<br />\n";
    }
} else {
    echo "Erro ao ler a página";
}
