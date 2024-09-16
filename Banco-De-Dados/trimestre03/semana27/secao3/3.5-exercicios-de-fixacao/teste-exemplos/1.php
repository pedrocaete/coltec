<?php
$handle = fopen(’ArquivoInexistente.txt’,’r’);
var_dump($handle);
// fclose ( $handle ) ;
echo " <br> Agora abrindo um arquivo que existe <br> " ;
$handle = fopen(’ArquivoExistente.txt’, ’r’);
var_dump($handle);
// fechando
echo " <br> ap ó s fechar <br> " ;
fclose($handle);
var_dump($handle);
?>
