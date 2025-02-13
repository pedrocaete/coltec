<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class LoginDAO
{
    public function insert($email, $password)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO login (email, senha) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$email, $password]);
        return $isSuccessful;
    }

    public function getLogin($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM login WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $login = $stmt->execute([$id]);
        return $login;
    }

    public function getID($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM login WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $id = $stmt->execute([$email]);
        return $id;
    } 

    public function getEmail($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT email FROM login WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $email = $stmt->execute([$id]);
        return $email; 
    } 

    public function getPassword($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT senha FROM login WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $password = $stmt->execute([$id]);
        return $password; 
    } 

    public function alterEmail($newEmail, $id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATLE login SET email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$newEmail, $id]);
        return $isSuccessful;
    }

    public function alterPassword($newPassword, $id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE login SET password = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$newPassword, $id]);
        return $isSuccessful;
    }

    public function verifyEmail($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT email FROM login WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $exists = $stmt->execute([$email]);
        return $exists;
    }

    public function list()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }
}
