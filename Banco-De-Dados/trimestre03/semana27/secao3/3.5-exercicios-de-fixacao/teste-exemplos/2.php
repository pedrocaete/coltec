<?php
$filename = "tmp.txt ";
$file = fopen($filename, " r ");
if ($file == false) {
    echo (" Erro ao tentar abrir o arquivo ");
    exit();
}
$filesize = filesize($filename);
// usa a funcao frea ()
$filetext = fread($file, $filesize);
fclose($file);
echo (" Tamanho do arquivo : $filesize bytes ");
// mostra o conteudo do arquivo lido
echo (" <pre > $filetext </ pre > ");
