<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../classes/Purchase.php";
require_once "../classes/Form.php";
require_once "../classes/User.php";

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário e Compras no Periodo</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="post">
            <label for="initialDate">Escolha a Data Inicial:</label>
            <input type="date" name="initialDate" required><br>

            <label for="finalDate">Escolha a Data Inicial:</label>
            <input type="date" name="finalDate" required><br>

            <label for="cpf">Usuário: </label> <br>
            <select id="cpf" name="cpf" required>
                <option value="">Selecione...</option>
                <?php
                foreach (UserDAO::listAll() as $user) {
                    echo '<option value="' . $user["cpf"] . '">' . $user["cpf"] . ": " . $user["nome"] . '</option>';
                }

                ?>
            </select> <br><br>

            <input type="submit" name="submit" value="Enviar">
        </form>
        <?php

        if (isset($_POST['submit'])) {
            User::getDataByCpf(Form::getCpf());
            User::listPurchasesByTimePeriod(Form::getCpf(), Form::getField("initialDate"), Form::getField("finalDate"));
        }
        ?>
    <a href='consultas.html'>Voltar</a><br>
    </div>
</body>

</html>
