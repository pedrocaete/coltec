<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "../../classes/user/UserInfo.php";

$user = new UserInfo();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <?php UserInfo::listAll(); ?>

    <a class='upperText' href='index.html'>Voltar</a><br>
</body>

</html>
