<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "../classes/User.php";
require_once "../classes/DAO/PurchaseDAO.php";

$usuarioSorteado = User::sortUser();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteio de Usuário</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Sorteio de Usuário</h1>
        <p>O usuário sorteado para ganhar <?php echo PurchaseDAO::getTotalValue() ?> é:</p>
        <div class="resultado">
            <?php echo $usuarioSorteado['nome'] . "<br> CPF: " . $usuarioSorteado['cpf']; ?>
        </div>
    </div>
</body>

</html>
