<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Usuário</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class='mainText'>
            <form method="post">
                <h1>Cadastro Usuário</h1>
                <label for="name">Usuário:</label> <br>
                <input type="text" name="name" value="" maxlength="100"><br> <br>

                <label for="cpf">CPF:</label> <br>
                <input type="text" name="cpf" value="" minlength="11" maxlength="11"><br> <br>

                <label for="email">Email: </label> <br>
                <input type="text" name="email" value="" maxlenght="255"> <br> <br>

                <label for="phone">Telefone (DDD 31 já incluído): </label> <br>
                <input type="text" name="phone" value="" minlength="8" maxlength="9"> <br> <br>

                <label for="password">Senha:</label> <br>
                <input type="password" name="password" value=""> <br> <br>

                <input type="submit" name="submit" value="Cadastrar"> <br><br>
            </form>
        </div>
        <a class='upperText' href='login_usuario.php'>Já tenho conta</a>
        <a href='index.html'>Voltar ao Menu</a>

        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/User.php";
        require_once "../classes/UserSession.php";

        if (isset($_POST['submit'])) {
            $user = new User;
            $user->register();
            $userSession = new UserSession();
            $userSession->createSession($user);
            header('Location: menu_usuario.html');
        }
        ?>
    </div>
</body>

</html>
