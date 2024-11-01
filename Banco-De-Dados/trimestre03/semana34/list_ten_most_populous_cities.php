<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/Classes/Utils.php';
require_once dirname(__FILE__) . '/Classes/DAO.php';

        echo "<table border='1'>";
        foreach (DAO::listTenMostPopulousCities() as $row) {
            echo "<tr>" .
                "<td>" . $row['Municipio'] . "</td>" .
                "</tr>";
        }
        echo "</table>";
?>
</body>

</html>
