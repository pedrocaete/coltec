<?php
// inicia a sessão
session_start();
$f =  $_SESSION['cor'];
$c = $_SESSION['figura'];
$t = $_SESSION['tamanho'];
echo "<br>Você escolheu: ".$c.", ",$f.", ".$t."<br>";
echo "encerrando a sessão...";
session_destroy();

echo "<br>Próxima página não 
                 terá as variáveis...confira:<br> 
                         <a href='SessaoFechada.php'>Continuar...</a>";
?>
