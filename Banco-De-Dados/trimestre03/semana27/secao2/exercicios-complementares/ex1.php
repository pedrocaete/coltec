<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ex1</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Verificar número primo</h1>
        <form method="get">
            <label for="num">Digite o número</label>
            <input type="number" name="num" value="">
            <input type="submit" value="Enviar">
        </form>
        <?php
        function isPrimeNumber($num)
        {
            $isPrimeNumber = true;
            for ($i = 2; $i < $num/2; $i ++){
                if($num % $i == 0) {
                    $isPrimeNumber = false; 
                    break;
                }
            }
            return $isPrimeNumber;
        }        

        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["num"])) {
            $num = $_GET["num"];
            if (isPrimeNumber($num)) {
                echo "<p style='color:green'>O número é primo</p>";
            }
            else {
                echo "<p style='color:red'>O número não é primo</p>";
            }
        }
        ?>
    </body>
</html>
