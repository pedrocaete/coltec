<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once 'DAO.php';
class Utils
{
    public static function list($list)
    {
        echo "<table border='1'>";
        foreach ($list as $row) {
            echo "<tr>" .
                "<td>" . $row['Posicao'] . "</td>" .
                "<td>" . $row['CodigoIBGE'] . "</td>" .
                "<td>" . $row['Municipio'] . "</td>" .
                "<td>" . $row['Estado'] . "</td>" .
                "<td>" . $row['Populacao'] . "</td>" .
                "<td>" . $row['Sigla Estado'] . "</td>" .
                "</tr>";
        }
        echo "</table>";
    }
}
