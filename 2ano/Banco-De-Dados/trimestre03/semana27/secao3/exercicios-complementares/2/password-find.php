<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reader</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Password Finder</h1>
    <form method="post">

        <label for="usuario">Nome do Usuário: </label>
        <input type="text" name="usuario" value=""> <br>

        <input type="submit" name="submit" value="Enviar"> <br><br>
    </form>

    <h3>Senha</h3>
    <p><?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $usuario = $_POST['usuario'];
        echo findPassword('passwords.txt', $usuario);
    }

    ?></p> <br><br>


    <a href="index.html">Voltar ao Menu</a> <br>
    <a href="read-passwords.php">Ler Arquivo de Senhas</a> <br>
    <a href="password-input.php">Armazenar Nova Senha</a> <br>
</body>

</html>
<?php
function findPassword($filename, $usuario)
{
    $linhas = file($filename, FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as  $linha) {
        $palavras = explode(":", $linha);
        if ($palavras[0] == $usuario) {
            return $palavras[1];
        }
    }
    return "Usuário não encontrado";
}

?>
