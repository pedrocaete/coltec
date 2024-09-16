<?php

$filename = "7.txt";
$file = fopen($filename, "w");

if ($file) {
    for ($i = 0; $i < 10; $i++) {
        $key = uniqid();
        $value = rand(1, 100);
        $line = $key . " : " . $value . "\n";
        fwrite($file, $line);
    }
    fclose($file);
}
else {
    echo "Erro ao escrever no arquivo";
}
