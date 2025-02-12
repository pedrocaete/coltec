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
                <h1>Login Admin</h1>
                <label for="password">Digite a senha:</label> <br>
                <input type="password" name="password" value=""> <br> <br>

                <input type="submit" name="submit" value="Login"> <br><br>
            </form>
        </div>
        <a class='upperText' href='index.html'>Voltar ao Menu</a>
        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/User.php";
        require_once "../classes/UserSession.php";

        if (isset($_POST['submit'])) {
            if (password_verify(Form::getPassword(), "$2y$10\$vAjIR1n/pWj5fefi58TyAO8Emr7uYkz5zWLoqX5wTkZw0fV6mZ62K")) {
                header('Location: menu_admin.php');
            }
        }
        ?>
    </div>
</body>

</html>
