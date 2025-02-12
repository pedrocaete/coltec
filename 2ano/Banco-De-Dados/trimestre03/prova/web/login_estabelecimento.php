<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Estabelecimento</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class='mainText'>
            <form method="post">
                <h1>Login Estabelecimento</h1>
                <label for="cnpj">CNPJ:</label> <br>
                <input type="text" name="cnpj" value="" minlength="14" maxlength="14"><br> <br>

                <label for="password">Senha:</label> <br>
                <input type="password" name="password" value=""> <br> <br>

                <input type="submit" name="submit" value="Login"> <br><br>
            </form>
        </div>
        <a class='upperText' href='cadastro_estabelecimento.php'>Não tenho conta</a>
        <a href='index.html'>Voltar ao Menu</a>
        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/Establishment.php";
        require_once "../classes/EstablishmentSession.php";

        if (isset($_POST['submit'])) {
            $establishment = new Establishment();
            $establishment->login();
            $establishmentSession = new EstablishmentSession();
            $establishmentSession->createSession($establishment);
            header('Location: menu_estabelecimento.html');
        }
        ?>
    </div>
</body>

</html>
