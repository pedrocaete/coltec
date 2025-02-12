<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <a href='logout.php'>Logout</a> <!-- COLOCAR PRA DESTRUIR A SESSION-->
        <a href='consultas.html'>Consultas</a>
        <form method="post">
            <button type="submit" name="button" value="listUsers">Listar Usuários</button>
            <button type="submit" name="button" value="listEstablishments">Listar Estabelecimentos</button>
        </form>
        <?php
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        require_once "../classes/Admin.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['button'])) {
                $button = $_POST['button'];

                if ($button === 'listUsers') {
                    Admin::listUsersAndPurchases();
                } elseif ($button === 'listEstablishments') {
                    Admin::listEstablishmentsAndSales();
                }
            }
        }
        ?>
    </div>
</body>

</html>
