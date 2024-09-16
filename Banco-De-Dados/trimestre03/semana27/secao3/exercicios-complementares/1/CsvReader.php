<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSV Reader</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php

    $filename = "sample_data.csv";
    $file = fopen($filename, "r");

    if ($file) {
        echo "<table border='1'>";
        $htmlTag = 1;
        while (($row = fgetcsv($file))) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        fclose($file);
    } else {
        echo "Erro ao ler CSV";
    }
    ?>
</body>

</html>
