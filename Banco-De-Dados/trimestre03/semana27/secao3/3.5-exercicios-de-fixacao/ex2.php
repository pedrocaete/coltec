<?php
$file = fopen("ex1.txt", "w");
$conteudoArquivo = "";
for ($i = 1; $i <= 11; $i++) {
    if ($i == 11) {
        $conteudoArquivo .= "Mais uma linha \n";
    } else {
        $conteudoArquivo .= "Linha $i \n";
    }
}
fwrite($file, $conteudoArquivo);
fclose($file);
