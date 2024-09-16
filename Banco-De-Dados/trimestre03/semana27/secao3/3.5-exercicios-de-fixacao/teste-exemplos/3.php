<?php
$filename = "exemplo3.txt ";
$file = fopen($filename, "w");

if ($file == false) {
    echo (" Erro ao tentar criar o arquivo ");
    exit();
}
fwrite($file, " Arquivo teste \ n ... segunda linha \ n ");
fclose($file);
