<!DOCTYPE html>
<html lang='pt'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Dados <?php $user->username ?></title>
    <link href='../css/style.css' rel='stylesheet'>
</head>

<body>
    <?php

    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);

    require_once "User.php";

    session_start();
    $user = User::unserialize($_SESSION['User']);
    echo "<div class='mainText'>";
    echo 'Nome: ' . $user->username . '<br>' .
        'Email: ' .  $user->email . '<br>' .
        'Data de nascimento: ' . $user->birth . '<br>' .
        'Cargo: ' . $user->acesso . '<br>';

    ?>
    </div>
    <div id='bah'>
        <a class='button' href='alter_data.php'>Alterar Dados</a><br>
        <a class='button' href='change_password.php'>Alterar Senha</a><br>
        <a class='button' href='remove_user.php'>Remover Usuário</a><br>
    </div>
    <a class='upperText' href='logout.php'>Logout</a><br>
    <?php
        if($user->acesso == 'gerente'){
        echo "<a href='area_gerente.php'>Área Gerente</a>";
        }
        if($user->acesso == 'admin'){
        echo "<a href='area_admin.php'>Área Admin</a>";
        }
    ?>
</body>

</html>