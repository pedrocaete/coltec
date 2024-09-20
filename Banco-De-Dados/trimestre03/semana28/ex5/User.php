<?php

require_once "db_config.php";

class User
{
    public $username;
    public $password;
    public $pdo;

    public function __construct()
    {
        $this->pdo = connectDB();
    }
    public function getData()
    {
        $this->username = $this->getUsername();
        $this->password = password_hash($this->getPassword(), PASSWORD_DEFAULT);
    }

    private function getUsername()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $username = $_POST['user'];
            if (empty($username)) {
                throw new InvalidArgumentException('Nome não pode estar vazio');
            }
            return $username;
        }
    }

    private function getPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $password = $_POST['password'];
            if (empty($password)) {
                throw new InvalidArgumentException('A senha precisa de no mínimo 1 caractere');
            }
            return $password;
        }
    }

    public static function exists($username, $pdo)
    {
        $sql = "select nome from usuario where nome=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function insert()
    {
        $sql = "insert into usuario values (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username, $this->password]);
        if ($stmt) {
            echo "Usuário Cadastrado com Sucesso";
        } else {
            echo "Erro ao cadastrar usuário";
        }
    }

    public function checkPassword($passwordGived)
    {
        $sql = "select senha from usuario where nome=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username]);
        $password = $stmt->fetchColumn();
        if (password_verify($passwordGived, $password)) {
            return true;
        } else {
            return false;
        }
    }

    public function register()
    {
        $password = $this->getPassword();
        if ($this->exists($this->username, $this->pdo)) {
            echo "Usuário já existe";
        } else {
            $this->insert($this->username, $password);
        }
    }

    public function login()
    {
        $password = $this->getPassword();
        if ($this->exists($this->username, $this->pdo)) {
            if ($this->checkPassword($password)) {
                session_start();
                $_SESSION['User'] = $this->serialize();
                echo "Logado";
            } else {
                echo "Senha incorreta";
            }
        } else {
            echo "Usuário inexistente";
        }
    }

    private function sqlChangePassword($newPassword)
    {
        $sql = "UPDATE usuario SET senha=? WHERE nome=?";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute([$newPassword, $this->username]);
            echo "Senha alterada com sucesso";
        } catch (PDOException $e) {
            echo "Erro ao alterar senha: " . $e->getMessage();
        }
    }

    public function changedPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            if (empty($newPassword)) {
                echo 'A senha precisa de no mínimo 1 caractere <br>';
            }
            if ($newPassword == $confirmPassword) {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $confirmPassword = null; //To previne password leaks
                $this->sqlChangePassword($newPassword);
            } else {
                echo 'Senha de confirmação diverge da nova senha <br>';
            }
        }
    }

    public function serialize()
    {
        return array(
            'username' => $this->username,
            'password' => $this->password,
        );
    }

    public static function unserialize($data)
    {
        $user = new self();
        $user->username = $data['username'];
        $user->password = $data['password'];
        return $user;
    }
}
