<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex4</title>
</head>

<body>

    <h1>Inverter String</h1>
    <form method="get">
        <label for="string">Digite a palavra:</label>
        <input type="text" id="string" name="string"><br><br>
        <input type="submit" value="Inverter">
    </form>

    <?php
    function revertString($string)
    {
        $revertedString = "";
        for($i = strlen($string) - 1; $i >= 0; $i--){
            $revertedString .= $string[$i];
        }
        return $revertedString;
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['string'])) {
        $string = $_GET["string"];

        $string = revertString($string);
       
        echo "<h2>String Invertida</h2>";
        echo "<p> $string </p>";
    }
    ?>

</body>

</html>