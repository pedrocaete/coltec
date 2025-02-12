<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../classes/DAO/EstablishmentDAO.php";
require_once "../classes/Purchase.php";
require_once "../classes/User.php";
require_once "../classes/UserSession.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Compra</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class='mainText'>
            <form method="post">
                <h1>Cadastrar Compra</h1>
                <label for="date">Data da Compra:</label> <br>
                <input type="date" name="date" value="" max="<?php echo date('Y-m-d'); ?>" required><br> <br>

                <label for="value">Valor da Compra:</label> <br>
                <input type="number" name="value" value="" step="any" min="0.01" required><br> <br>

                <label for="cnpj">Estabelecimento: </label> <br>
                <select id="cnpj" name="cnpj" required>
                    <option value="">Selecione...</option>
                    <?php
                    foreach (EstablishmentDAO::listAll() as $establishment) {
                        echo '<option value="' . $establishment["cnpj"] . '">' . $establishment["nome"] . '</option>';
                    }

                    ?>
                </select> <br><br>

                <input type="submit" name="submit" value="Cadastrar"> <br><br>
            </form>
        </div>
        <a href='menu_usuario.html' class="button-01" role="button">
            Voltar
        </a>

        <?php

        if (isset($_POST['submit'])) {
            $userSession = new UserSession();
            $userSession->useSession();
            $user = $userSession->user;
            $purchase = new Purchase;
            $purchase->register($user);
        }
        ?>
    </div>
</body>

</html>
