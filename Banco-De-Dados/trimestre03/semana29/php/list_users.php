<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <?php

    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);

    require_once "User.php";
    require_once "../database/db_config.php";
    session_start();
    $user = User::unserialize($_SESSION['User']);

    User::listAll(connectDB());

        if($user->acesso == 'gerente'){
        echo "<a class='upperText' href='../php/area_gerente.php'>Voltar</a><br>";
        }
        if($user->acesso == 'admin'){
        echo "<a class='upperText' href='../php/area_admin.php'>Voltar</a><br>";
        }
    ?>
</body>

</html>
