<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database/database.php';
require_once dirname(__FILE__) . '/../Exceptions/EmptyDatabaseColumnException.php';

class EstablishmentDAO
{
    public static function insert($establishment)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO prova_estabelecimento VALUES(?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$establishment->cnpj, $establishment->name, $establishment->email, $establishment->password]);
        if ($stmt) {
            echo "Estabelecimento Cadastrado com Sucesso";
        } else {
            echo "Erro ao Cadastrar Estabelecimento";
        }
    }

    public static function listAll(){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_estabelecimento
                ORDER BY cnpj ASC;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function fetchColumn($cnpj, $column)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT $column FROM prova_estabelecimento WHERE cnpj = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cnpj]);
        $result = $stmt->fetchColumn();
        if ($result){
            return $result;
        }
        else {
            echo "Coluna " . $column . " vazia para usuário com CNPJ " . $cnpj;
        }
    }

    private static function updateColumn($cnpj, $column, $value)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE prova_estabelecimento SET $column = ? WHERE cnpj = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value, $cnpj]);
    }

    // Getters
    public static function getName($cnpj)
    {
        return self::fetchColumn($cnpj, 'nome');
    }

    public static function getEmail($cnpj)
    {
        return self::fetchColumn($cnpj, 'email');
    }

    public static function getPassword($cnpj)
    {
        return self::fetchColumn($cnpj, 'senha');
    }

    public static function getCnpj($cnpj)
    {
        return self::fetchColumn($cnpj, 'cnpj');
    }

    // Updaters
    public static function updateName($cnpj, $nome)
    {
        self::updateColumn($cnpj, 'nome', $nome);
    }

    public static function updateEmail($cnpj, $email)
    {
        self::updateColumn($cnpj, 'email', $email);
    }

    public static function updatePassword($cnpj, $senha)
    {
        self::updateColumn($cnpj, 'senha', $senha);
    }

    public static function updateCnpj($cnpj, $newCnpj)
    {
        self::updateColumn($cnpj, 'cnpj', $newCnpj);
    }
}
