<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
</body>

</html>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $wantedWord = $_POST['palavra'];
    findWord($wantedWord, "oi.txt");
}

function findWord($wantedWord, $filename)
{
    $lines = file($filename);
    foreach ($lines as $numLine => $line) {
        $line = explode(' ', $line);
        foreach ($line as $word) {
            $word = trim($word);
            if ($word == $wantedWord) {
                echo $numLine + 1 . "<br>";
                break;
            }
        }
    }
}
?>
