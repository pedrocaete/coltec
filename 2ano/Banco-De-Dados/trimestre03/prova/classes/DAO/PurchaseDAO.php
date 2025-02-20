<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database/database.php';
require_once dirname(__FILE__) . '/../Exceptions/EmptyDatabaseColumnException.php';

class PurchaseDAO
{
    public static function insert($purchase)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO prova_compra (data, valor, cpf_usuario, cnpj_estabelecimento) VALUES(?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$purchase->date, $purchase->value, $purchase->user_cpf, $purchase->establishment_cnpj]);
        if ($stmt) {
            echo "Compra Cadastrada com Sucesso";
        } else {
            echo "Erro ao Cadastrar Compra";
        }
    }

    public static function listAllByCnpj($cnpj)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_compra WHERE cnpj_estabelecimento = ? ORDER BY data DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cnpj]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listAllByCpf($cpf)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_compra WHERE cpf_usuario = ? ORDER BY data DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listAllByCpfAndTimePeriod($cpf, $initialDate, $finalDate)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_compra c 
                WHERE cpf_usuario = ?
                AND c.data BETWEEN ? AND ?
                ORDER BY  cpf_usuario ASC, data DESC;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf, $initialDate, $finalDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_compra
        ORDER BY data DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listTotalValueByTimePeriod($initialDate, $finalDate)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT SUM(c.valor) AS vendas
                FROM prova_compra c
                WHERE c.data BETWEEN ? AND ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$initialDate, $finalDate]);
        return $stmt->fetchColumn();
    }

    public static function getTotalValue()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT SUM(c.valor) AS vendas
                FROM prova_compra c;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    private static function fetchColumn($id, $column)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT $column FROM prova_compra WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        if ($result) {
            return $result;
        } else {
            echo"Coluna " . $column . " vazia para usuário com ID " . $id;
        }
    }

    private static function updateColumn($id, $column, $value)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE prova_compra SET $column = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value, $id]);
    }

    // Getters
    public static function getData($id)
    {
        return self::fetchColumn($id, 'data');
    }

    public static function getValor($id)
    {
        return self::fetchColumn($id, 'valor');
    }

    public static function getCpf($id)
    {
        return self::fetchColumn($id, 'cpf');
    }

    public static function getCnpj($id)
    {
        return self::fetchColumn($id, 'cnpj');
    }

    // Updaters
    public static function updateData($id, $data)
    {
        self::updateColumn($id, 'data', $data);
    }

    public static function updateValor($id, $valor)
    {
        self::updateColumn($id, 'valor', $valor);
    }

    public static function updateCpf($id, $cpf)
    {
        self::updateColumn($id, 'cpf', $cpf);
    }

    public static function updateCnpj($id, $newCnpj)
    {
        self::updateColumn($id, 'cnpj', $newCnpj);
    }
}
