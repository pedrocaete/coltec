<?php
// inicia a sessão
session_start();
$figuras = 
    array("circ"=>"Círculo","quad"=>"Quadrado",
               "elips"=>"Elipse","triang"=>"Triângulo");
$cores = 
    array("yellow"=>"Amarelo","red"=>"Vermelho",
                      "blue"=>"Azul","green"=>"Verde");
// dados do formulario
if(isset($_POST['submit'])){
    $f = $_POST['figura'];
    $c = $_POST['cor'];
    $t = $_POST['tamanho'];
    $fig = $figuras[$f];
    $cor = $cores[$c];
    $tam = $t;
    $_SESSION['cor'] = $cor;
    $_SESSION['figura'] = $fig;
    $_SESSION['tamanho'] = $t;
    echo "<br>Você escolheu: 
              ".$cor.", ",$fig.", ".$tam."<br>";

    echo "<br><a href='DadosForm.php'>
               Continuar...</a>";
}
?>
