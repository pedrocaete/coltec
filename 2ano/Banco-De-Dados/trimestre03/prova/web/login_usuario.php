<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Usuário</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class='mainText'>
            <form method="post">
                <h1>Login Usuário</h1>
                <label for="cpf">CPF:</label> <br>
                <input type="text" name="cpf" value="" minlength="11" maxlength="11"><br> <br>

                <label for="password">Senha:</label> <br>
                <input type="password" name="password" value=""> <br> <br>

                <input type="submit" name="submit" value="Login"> <br><br>
            </form>
        </div>
        <a class='upperText' href='cadastro_usuario.php'>Não tenho conta</a>
        <a href='index.html'>Voltar ao Menu</a>
        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/User.php";
        require_once "../classes/UserSession.php";

        if (isset($_POST['submit'])) {
            $user = new User;
            $user->login();
            $userSession = new UserSession();
            $userSession->createSession($user);
            header('Location: menu_usuario.html');
        }
        ?>
    </div>
</body>

</html>
