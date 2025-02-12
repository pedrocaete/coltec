<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST["txtbox"];
    $checkbox1 = isset($_POST["checkbox1"]) ? $_POST["checkbox1"] : 'Não selecionado';
    $checkbox2 = isset($_POST["checkbox2"]) ? $_POST["checkbox2"] : 'Não selecionado';
    $checkbox3 = isset($_POST["checkbox3"]) ? $_POST["checkbox3"] : 'Não selecionado';
    $dropdown = $_POST["dropdown"];
    $multipla = $_POST["multipla"];
    echo $texto . "<br>" . $checkbox1 . "<br>" . $checkbox2 . "<br>" . $checkbox3 . "<br>" .  $dropdown . "<br>" . $multipla;
}
?>
