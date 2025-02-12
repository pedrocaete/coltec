<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dir Creator</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
    $dir = $_POST["diretorio"];
    echo "<h3>" . dirCreate($dir) . "</h3>";
}

function dirCreate($dir)
{
    if (is_dir($dir)) {
        echo "O diretório já existe";
    } else {
        if (mkdir($dir)) {
            echo "Diretório criado";
        } else {
            echo "Erro ao criar diretório";
        }
    }
}
