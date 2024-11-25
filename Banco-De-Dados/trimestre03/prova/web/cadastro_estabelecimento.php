<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Estabelecimento</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class='mainText'>
            <form method="post">
                <h1>Cadastro Establecimento</h1>
                <label for="name">Establecimento:</label> <br>
                <input type="text" name="name" value="" maxlength="100"><br> <br>

                <label for="cnpj">CNPJ:</label> <br>
                <input type="text" name="cnpj" value="" minlength="14" maxlength="14"><br> <br>

                <label for="email">Email: </label> <br>
                <input type="text" name="email" value="" maxlength="255"> <br> <br>

                <label for="password">Senha:</label> <br>
                <input type="password" name="password" value=""> <br> <br>

                <input type="submit" name="submit" value="Cadastrar"> <br><br>
            </form>
        </div>
        <a class='upperText' href='login_estabelecimento.php'>Já tenho conta</a>
        <a href='index.html'>Voltar ao Menu</a>

        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/Establishment.php";
        require_once "../classes/EstablishmentSession.php";

        if (isset($_POST['submit'])) {
            $establishment = new Establishment;
            $establishment->register();
            $establishmentSession = new EstablishmentSession();
            $establishmentSession->createSession($establishment);
            header('Location: menu_estabelecimento.html');
        }
        ?>
    </div>
</body>

</html>
