<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/db_connection.php';

class funcionarioDAO
{
    public function insert($user_id, $wage, $sector)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO funcionario (id_usuario, salario, setor) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$user_id, $wage, $sector]);
        return $isSuccessful;
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function getIDbyEmail($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM funcionario WHERE id_usuario = (SELECT id FROM login WHERE email = ?)";
        $stmt = $pdo->prepare($sql);
        $id = $stmt->execute([$email]);
        return $id;
    }

    public function getFuncionario($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $funcionario;
    }

    public function getIDbyUserID($userID)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM funcionario WHERE id_usuario = (SELECT id FROM usuario WHERE id = ?)";
        $stmt = $pdo->prepare($sql);
        $id = $stmt->execute([$userID]);
        return $id;
    }

    public function getUserID($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id_usuario FROM funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $userID = $stmt->execute([$id]);
        return $userID;
    }

    public function getWage($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT salario FROM funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $wage = $stmt->execute([$id]);
        return $wage;
    }

    public function getSector($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT setor FROM funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $sector = $stmt->execute([$id]);
        return $sector;
    }

    public function alterWage($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE funcionario SET salario = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $wageisSuccessful;
    }

    public function alterSector($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE funcionario SET setor = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM funcionario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listBySector($sector)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM funcionario WHERE setor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$sector]);
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listByWageGreaterThan($wage)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM funcionario WHERE salario > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$wage]);
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }
}
