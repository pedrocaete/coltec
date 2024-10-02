<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar Status do Usuário</title>
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <div class='mainText'>
        <form method="post">
            <h1>Alterar Status Usuário </h1>
            <label for="email">Email do Usuário a ser removido: </label><br>
            <input type="text" name="email" value=""><br><br>
            <label for="newStatus">Novo Status do Usuário</label><br>
            <select name="newStatus">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
            <br<br>
                <input type="submit" name="ativar" value="Alterar Status">
        </form>
    </div>
    <a class='upperText' href='index.html'>Voltar</a><br>
</body>

</html>
