<?php

$file = fopen("ex1.txt", "r");
if ($file) {
    $filesize = filesize("ex1.txt");
    $content = fread($file, $filesize);
    echo $content;
    fclose($file);
} else {
    echo "Erro ao abrir o arquivo.";
}
?>
