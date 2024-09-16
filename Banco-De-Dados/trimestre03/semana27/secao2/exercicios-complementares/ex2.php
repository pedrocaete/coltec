<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex2</title>
</head>

<body>

    <h1>Verificador de Palíndromas</h1>
    <form method="get">
        <label for="string">Digite a palavra:</label>
        <input type="textarea" id="string" name="string"><br><br>
        <input type="submit" value="Verificar">
    </form>

    <?php
    function isPalindrome($string)
    {
        return strrev($string) == $string;
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['string'])) {
        $string = $_GET["string"];

        if (isPalindrome($string)) {
            echo "<p>A palavra $string é um palíndromo</p>";
        } else {
            echo "<p>A palavra $string não é um palíndromo</p>";
        }
    }
    ?>

</body>

</html>