<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Dados do aluno</h1>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $cidade = $_POST['cidade'];
        $matricula = $_POST['matricula'];
        $curso = $_POST['curso'];
        $periodo = $_POST['periodo'];
        $_SESSION['nome'] = $nome;
        $_SESSION['idade'] = $idade;
        $_SESSION['cidade'] = $cidade;
        $_SESSION['matricula'] = $matricula;
        $_SESSION['curso'] = $curso;
        $_SESSION['periodo'] = $periodo;
        echo "<p>Nome: $nome</p>";
        echo "<p>Idade: $idade</p>";
        echo "<p>Cidade: $cidade</p>";
        echo "<p>Matricula: $matricula</p>";
        echo "<p>Curso: $curso</p>";
        echo "<p>Periodo: $periodo</p>";
    }
    ?>
    <a href="session.php">Link para o uso de sessão para envio dos dados</a>
</body>

</html>
