<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database/database.php';
require_once dirname(__FILE__) . '/../User.php';
require_once dirname(__FILE__) . '/../Exceptions/EmptyDatabaseColumnException.php';

class UserDAO
{
    public static function insert($user)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO prova_usuario VALUES(?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user->cpf, $user->name, $user->email, $user->phone, $user->password]);
        if ($stmt) {
            echo "Usuário Cadastrado com Sucesso";
        } else {
            echo "Erro ao Cadastrar Usuário";
        }
    }

    public static function listAll(){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM prova_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listAllByCpf($cpf){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT nome, email, telefone, cpf FROM prova_usuario WHERE cpf = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result){
            return $result;
        }
        else {
            throw new EmptyDatabaseColumnException("Colunas não preenchidas para usuário com CPF " . $cpf );
        }
    }

    private static function fetchColumn($cpf, $column)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT $column FROM prova_usuario WHERE cpf = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $result = $stmt->fetchColumn();
        if ($result){
            return $result;
        }
        else {
            throw new EmptyDatabaseColumnException("Coluna " . $column . " vazia para usuário com CPF " . $cpf );
        }
    }

    private static function updateColumn($cpf, $column, $value)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE prova_usuario SET $column = ? WHERE cpf = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value, $cpf]);
    }

    // Getters
    public static function getName($cpf)
    {
        return self::fetchColumn($cpf, 'nome');
    }

    public static function getEmail($cpf)
    {
        return self::fetchColumn($cpf, 'email');
    }

    public static function getPhone($cpf)
    {
        return self::fetchColumn($cpf, 'telefone');
    }

    public static function getPassword($cpf)
    {
        return self::fetchColumn($cpf, 'senha');
    }

    // Updaters
    public static function updateName($cpf, $nome)
    {
        self::updateColumn($cpf, 'nome', $nome);
    }

    public static function updateEmail($cpf, $email)
    {
        self::updateColumn($cpf, 'email', $email);
    }

    public static function updatePhone($cpf, $telefone)
    {
        self::updateColumn($cpf, 'telefone', $telefone);
    }

    public static function updatePassword($cpf, $senha)
    {
        self::updateColumn($cpf, 'senha', $senha);
    }
}