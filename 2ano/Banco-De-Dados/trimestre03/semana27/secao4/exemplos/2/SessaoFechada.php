<?php
// inicia a sessão
session_start();
var_dump($_SESSION);
$f =  $_SESSION['cor'];
$c = $_SESSION['figura'];
$t = $_SESSION['tamanho'];
echo "<br>Você escolheu: ".$c.", ",$f.", ".$t."<br>";
echo "<br><a href='formulario.html'>Voltar pro Início.</a>";
?>
