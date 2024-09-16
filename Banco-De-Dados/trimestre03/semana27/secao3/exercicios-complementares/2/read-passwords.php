<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reader</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Password Reader</h1>
    <table border="1">
        <?php echoFileAsTable("passwords.txt"); ?>
    </table>

    <a href="index.html">Voltar ao Menu</a> <br>
    <a href="password-input.php">Armazenar Nova Senha</a> <br>
    <a href="password-find.php">Buscar Senhas Salvas</a> <br>
</body>

</html>
<?php
function echoFileAsTable($filename)
{
    $linhas = file($filename, FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as  $linha) {
        $palavras = explode(":", $linha);
        echo "<tr>";
        echo "<td>" . $palavras[0] . "</td>";
        echo "<td>" . $palavras[1] . "</td>";
        echo "</tr>";
    }
}
?>
