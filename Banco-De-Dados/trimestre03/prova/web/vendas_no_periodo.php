<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../classes/Purchase.php";
require_once "../classes/Form.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendas no Periodo</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="post">
            <label for="initialDate">Escolha a Data Inicial:</label>
            <input type="date" name="initalDate" required><br>

            <label for="finalDate">Escolha a Data Inicial:</label>
            <input type="date" name="finalDate" required><br>

            <input type="submit" name="submit" value="Enviar">
        </form>
        <?php

        if (isset($_POST['submit'])) {
            Purchase::listSalesOnPeriod(Form::getField("initalDate"), Form::getField("finalDate"));
        }
        ?>
    <a href='consultas.html'>Voltar</a><br>
    </div>
</body>

</html>
