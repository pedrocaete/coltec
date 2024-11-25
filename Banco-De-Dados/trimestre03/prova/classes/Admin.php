<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once dirname(__FILE__) . '/DAO/UserDAO.php';
require_once dirname(__FILE__) . '/DAO/EstablishmentDAO.php';
require_once dirname(__FILE__) . '/DAO/PurchaseDAO.php';
require_once dirname(__FILE__) . '/DAO/DAO.php';
class Admin
{
    public static function listUsersAndPurchases()
    {
        $table = DAO::listUsersAndPurchases();
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>CPF</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Telefone</th>
                        <th scope='col'>Data</th>
                        <th scope='col'>Valor</th>
                    </tr>
                </thead>
                    <tbdody>";

        foreach ($table as $row) {
            echo "<tr>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['valor'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>
                </table>";
    }

    public static function listEstablishmentsSalesByMonth($month, $year)
    {
        $table = DAO::listEstablishmentsSellsByMonth($month, $year);
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>CNPJ</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Valor Vendas</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($table as $row) {
            echo "<tr>";
            echo "<td>" . $row['cnpj'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['vendas'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }

    public static function listEstablishmentsAndSales()
    {
        $table = DAO::listEstablishmentsAndSales();
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>CNPJ</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Data</th>
                        <th scope='col'>Valor</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($table as $row) {
            echo "<tr>";
            echo "<td>" . $row['cnpj'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['valor'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }

    public static function listUsersAndPurchasesByMonth($month, $year)
    {
        $table = DAO::listUsersAndPurchasesByMonth($month, $year);
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>CPF</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Telefone</th>
                        <th scope='col'>Compras</th>
                        <th scope='col'>Pontuação</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($table as $row) {
            echo "<tr>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "<td>" . $row['total_compras'] . "</td>";
            echo "<td>" . $row['pontos'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }
}
