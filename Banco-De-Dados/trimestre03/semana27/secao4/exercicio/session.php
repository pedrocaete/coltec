<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Dados do aluno</h1>
    <?php
    session_start();
    $nome = $_SESSION['nome'];
    $idade = $_SESSION['idade'];
    $cidade = $_SESSION['cidade'];
    $matricula = $_SESSION['matricula'];
    $curso = $_SESSION['curso'];
    $periodo = $_SESSION['periodo'];
    echo "<p>Nome: $nome</p>";
    echo "<p>Idade: $idade</p>";
    echo "<p>Cidade: $cidade</p>";
    echo "<p>Matricula: $matricula</p>";
    echo "<p>Curso: $curso</p>";
    echo "<p>Periodo: $periodo</p>";
    ?>
</body>

</html>
