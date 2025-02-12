<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Input</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Armazenar Nova Senha</h1>

    <form method="post">
        <label for="usuario">Nome de Usuário: </label>
        <input type="text" name="usuario" value=""> <br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" value=""> <br>

        <input type="submit" name="submit" value="Enviar"> <br><br>
    </form>

    <a href="index.html">Voltar ao Menu</a> <br>
    <a href="read-passwords.php">Ler Arquivo de Senhas</a> <br>
    <a href="password-find.php">Buscar Senhas Salvas</a> <br>
    <?php

    function processForm(&$usuario, &$senha)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            writeFile("passwords.txt", $usuario, $senha);
        }
    }
    function formatFileContent($usuario, $senha)
    {
        return $usuario . ": " . $senha . "\n";
    }
    function writeFile($filename, $usuario, $senha)
    {
        $file = fopen($filename, "a");
        $content = formatFileContent($usuario, $senha);
        fwrite($file, $content);
        fclose($file);
    }
    processForm($usuario, $senha);
    ?>
</body>

</html>
