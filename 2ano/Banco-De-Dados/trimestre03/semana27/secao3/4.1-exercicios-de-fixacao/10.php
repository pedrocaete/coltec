<?php

$filename = "9.txt";
$file = fopen($filename, "r");
$content = "";

if ($file) {
    while (!feof($file)) {
        $content .= fgets($file) . "<br>";
    }
    echo $content;
} else {
    echo "Erro ao ler o arquivo";
}

fclose($file);
