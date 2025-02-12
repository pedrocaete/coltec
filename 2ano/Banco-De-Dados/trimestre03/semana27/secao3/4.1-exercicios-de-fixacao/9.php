<?php
$arrayString = array("Pedro", "João", "Guilherme", "Ronaldo", "Amarildo");

$filename = "9.txt";
$file = fopen($filename, "w");
if ($file) {
    foreach ($arrayString as $numString => $string) {
        $outputString = $numString . "- " . $string . "\n";
        fwrite($file, $outputString);
    }
    fclose($file);
} else {
    echo "Erro ao escrever no arquivo";
}
