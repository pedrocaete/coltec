<?php

require_once "../database/Database.php";

class UserDAO
{
    public static function exists($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT email FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function insert($username, $email, $password, $birth, $acesso)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO pessoa (nome, email, senha, nascimento, acesso) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password, $birth, $acesso]);
        if ($stmt) {
            echo "Usuário Cadastrado com Sucesso";
        } else {
            echo "Erro ao Cadastrar Usuário";
        }
    }

    public static function changePassword($newPassword, $email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pessoa SET senha=? WHERE email=?";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([$newPassword, $email]);
            echo "Senha alterada com sucesso";
        } catch (PDOException $e) {
            echo "Erro ao alterar senha: " . $e->getMessage();
        }
    }

    public static function alterData($username, $birth, $email, $id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = 'UPDATE pessoa SET nome=?, nascimento=?, email=? WHERE id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $birth, $email, $id]);
    }

    public static function remove($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM pessoa WHERE email =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt) {
            echo "Usuário removido com sucesso!";
        } else {
            echo "Erro ao remover usuário";
        }
    }

    public static function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "select * from pessoa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

    public static function getStatus($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT status FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $status = $stmt->fetchColumn();

        return $status;
    }

    public static function getName($email){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT nome FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $nome = $stmt->fetchColumn();

        return $nome;
    }

    public static function getEmail($email){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT email FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $email = $stmt->fetchColumn();

        return $email;
    }
    
    public static function getBirth($email){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT nascimento FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $nascimento = $stmt->fetchColumn();

        return $nascimento;
    }

    public static function getAcesso($email){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT acesso FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $acesso = $stmt->fetchColumn();

        return $acesso;
    }

    public static function getPassword($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT password FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($email);
        $password = $stmt->fetchColumn();

        return $password;
    }

    public static function getID($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $id = $stmt->fetchColumn();

        return $id;
    }

    public static function getData($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pessoa WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}
