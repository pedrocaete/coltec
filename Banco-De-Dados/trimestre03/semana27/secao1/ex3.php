<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ex3</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <h1>Calculadora</h1>
        <form action="" method="post">
            <h2>Números</h2>
                <label for="numero1"></label>
                <input type="number" name="numero1" value="">
                <label for="numero2"></label>
                <input type="number" name="numero2" value="">

            <h2>Operações</h2>
                <input type="radio" name="operacao" value="+">
                <label for="operacao">+</label><br>
                <input type="radio" name="operacao" value="-">
                <label for="operacao">-</label><br>
                <input type="radio" name="operacao" value="X">
                <label for="operacao">X</label><br>
                <input type="radio" name="operacao" value="/">
                <label for="operacao">/</label><br>
                <input type="submit" value="Calcular">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $operacao = $_POST["operacao"];
            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            if ($operacao == "+") {
                $resultado = $numero1 + $numero2;
            }
            else if($operacao == "-") {
                $resultado = $numero1 - $numero2;
            }
            else if($operacao == "X") {
                $resultado = $numero1 * $numero2;
            }
            else if($operacao == "/") {
                $resultado = $numero1 / $numero2;
            }
            echo "<h1>Resultado</h1>
            <p>$resultado</p>";
        }
        ?>
    </body>
</html>
