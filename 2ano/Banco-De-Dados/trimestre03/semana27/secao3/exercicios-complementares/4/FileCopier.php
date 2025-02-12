<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Copiador de Arquivo</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $sourceName = $_POST['source'];
    $destName = $_POST['dest'];
    copyFile($sourceName, $destName);
}

function copyFile($sourceName, $destName)
{
    if (copy($sourceName, $destName)) {
        echo "Arquivo copiado com sucesso!";
    } else {
        echo "Erro ao copiar arquivo";
    }
}
?>
