<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../classes/Purchase.php";
require_once "../classes/User.php";
require_once "../classes/UserSession.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Compras</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php

        require_once "../classes/Establishment.php";
        require_once "../classes/EstablishmentSession.php";

        $establishmentSession = new EstablishmentSession();
        $establishmentSession->useSession();
        $establishment = $establishmentSession->establishment;
        $establishment->listPurchases();
        ?>
        <a href='menu_estabelecimento.html'>Voltar</a>
    </div>
</body>

</html>
