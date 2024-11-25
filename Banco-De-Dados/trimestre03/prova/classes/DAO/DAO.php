<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database/database.php';

class DAO
{
    public static function listUsersAndPurchasesByMonth($month, $year)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT u.nome, u.email, u.telefone, u.cpf, SUM(c.valor) AS total_compras, FLOOR(SUM(c.valor)/100) AS pontos
                FROM prova_usuario u
                JOIN prova_compra c ON c.cpf_usuario = u.cpf
                WHERE MONTH(c.data) = ? AND YEAR(c.data) = ?
                GROUP BY u.cpf;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$month, $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listEstablishmentsSellsByMonth($month, $year)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT e.nome, e.email, e.cnpj, SUM(c.valor) AS vendas
                FROM prova_estabelecimento e
                JOIN prova_compra c ON c.cnpj_estabelecimento= e.cnpj
                WHERE MONTH(c.data) = ? AND YEAR(c.data) = ?
        GROUP BY e.cnpj;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$month, $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listEstablishmentsAndSales()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT e.cnpj, e.nome, e.email, c.valor, c.data
                FROM prova_estabelecimento e
        JOIN prova_compra c ON e.cnpj =c.cnpj_estabelecimento
        ORDER BY e.cnpj ASC, c.data DESC;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listUsersAndPurchases()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT u.cpf, u.nome, u.email, u.telefone, c.data, c.valor
                FROM prova_usuario u
        JOIN prova_compra c ON u.cpf = c.cpf_usuario
        ORDER BY u.cpf ASC, c.data DESC;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
