<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../classes/Admin.php";
require_once "../classes/Form.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários e Suas Compras no Mês</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="post">
            <label for="month">Escolha o Mês:</label>
            <input type="month" id="month" name="month">

            <input type="submit" name="submit" value="Enviar">
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $year = Form::getYear();
            $month = Form::getMonth();
            Admin::listUsersAndPurchasesByMonth($month, $year);
        }
        ?>
    <a href='consultas.html'>Voltar</a><br>
    </div>
</body>

</html>
