<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class UserDAO
{
    public function insert($name, $phone, $cpf, $birth, $gender, $address, $access)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO usuario (nome, telefone, cpf, data_nascimento, genero, endereco, acesso) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$name, $phone, $cpf, $birth, $gender, $address, $access]);
        return $isSuccessful;
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function getID($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM login WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $id = $stmt->execute([$email]);
        return $id;
    } 

    public function getName($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT nome FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $name = $stmt->execute([$id]);
        return $name;
    }

    public function getPhone($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT telefone FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $phone = $stmt->execute([$id]);
        return $phone; 
    }

    public function getCpf($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT cpf FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $cpf = $stmt->execute([$id]);
        return $cpf;
    }

    public function getBirth($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT data_nascimento FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $birth = $stmt->execute([$id]);
        return $birth;
    }

    public function getGender($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT genero FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $gender = $stmt->execute([$id]);
        return $gender;
    }

    public function getAddress($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT endereco FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $address = $stmt->execute([$id]);
        return $address; 
    }

    public function getAccess($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT acesso FROM usuario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $access = $stmt->execute([$id]);
        return $access; 
    }

    public function alterName($id, $newName)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET nome = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newName]);
        return $isSuccessful;
    }

    public function alterPhone($id, $newPhone)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET telefone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newPhone]);
        return $isSuccessful;
    }

    public function alterCpf($id, $newCpf)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET cpf = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newCpf]);
        return $isSuccessful;
    }

    public function alterBirth($id, $newBirth)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET data_nascimento = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newBirth]);
        return $isSuccessful;
    }

    public function alterGender($id, $newGender)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET genero = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newGender]);
        return $isSuccessful;
    }

    public function alterAddress($id, $newAddress)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET endereco = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newAddress]);
        return $isSuccessful;
    }

    public function alterAccess($id, $newAccess)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE usuario SET acesso = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newAccess]);
        return $isSuccessful;
    }

    public function list()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }
}
