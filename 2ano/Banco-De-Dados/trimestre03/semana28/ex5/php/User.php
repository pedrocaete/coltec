<?php

require_once "../database/db_config.php";

class User
{
    public $username;
    public $password;
    public $email;
    public $birth;
    public $pdo;

    public function __construct()
    {
        $this->pdo = connectDB();
    }

    public function getRegisterData()
    {
        $this->username = $this->getUsername();
        $this->password = password_hash($this->getPassword(), PASSWORD_DEFAULT);
        $this->email = $this->getEmail();
        $this->birth = $this->getBirth();
    }

    public function getLoginData()
    {
        $this->email = $this->getEmail();
        $this->password = password_hash($this->getPassword(), PASSWORD_DEFAULT);
    }

    public function getDatabaseData()
    {
        $sql = "select * from usuario where email=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        while ($row = $stmt->fetch()) {
            $this->username = $row['nome'];
            $this->password = $row['senha'];
            $this->email = $row['email'];
            $this->birth = $row['nascimento'];
        }
    }

    private function getUsername()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $username = $_POST['user'];
            if (empty($username)) {
                echo '<p style="color:red">Preencha todos os campos</p>';
                exit;
            }
            return $username;
        }
    }

    private function getPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $password = $_POST['password'];
            if (empty($password)) {
                echo '<p style="color:red">A senha precisa de no mínimo 1 caractere</p>';
                exit;
            }
            return $password;
        }
    }

    private function getEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $email = $_POST['email'];
            if (empty($email)) {
                echo '<p style="color:red">Preencha todos os campos</p>';
                exit;
            }
            return $email;
        }
    }

    private function getBirth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $birth = $_POST['birth'];
            if (empty($birth)) {
                echo '<p style="color:red">Preencha todos os campos</p>';
                exit;
            }
            return $birth;
        }
    }

    public static function exists($email, $pdo)
    {
        $sql = "select email from usuario where email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function insertOnDatabase()
    {
        $sql = "insert into usuario values (?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username, $this->password, $this->email, $this->birth]);
        if ($stmt) {
            echo "Usuário Cadastrado com Sucesso";
        } else {
            echo "Erro ao Cadastrar Usuário";
        }
    }

    public function checkPassword($passwordGived)
    {
        $sql = "select senha from usuario where email=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $password = $stmt->fetchColumn();
        if (password_verify($passwordGived, $password)) {
            return true;
        } else {
            return false;
        }
    }

    public function register()
    {
        if ($this->exists($this->email, $this->pdo)) {
            echo "Já há um usuário associado a este email";
        } else {
            $this->insertOnDatabase();
            $this->startSession();
            return true;
        }
    }

    private function verifyUser()
    {
        $password = $this->getPassword();
        if ($this->exists($this->email, $this->pdo)) {
            if ($this->checkPassword($password)) {
                return true;
            } else {
                echo "Senha incorreta";
            }
        } else {
            echo "Usuário inexistente";
        }
    }

    public function startSession() {
        session_start();
        $_SESSION['User'] = $this->serialize();
    }
    public function login()
    {
        if ($this->verifyUser()) {
            $this->getDatabaseData();
            $this->startSession();
            echo "Logado";
            return true;
        }
    }

    private function changePasswordOnDatabase($newPassword)
    {
        $sql = "UPDATE usuario SET senha=? WHERE email=?";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute([$newPassword, $this->email]);
            echo "Senha alterada com sucesso";
        } catch (PDOException $e) {
            echo "Erro ao alterar senha: " . $e->getMessage();
        }
    }


    private function alterDatabaseData()
    {
        $sql = 'UPDATE usuario SET nome=?, nascimento=? WHERE email=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username, $this->birth, $this->email]);
    }

    public function alterData()
    {
        if (isset($_POST['submit'])) {
            $this->username = $this->getUsername();
            $this->birth = $this->getBirth();
            $this->alterDatabaseData();
            $_SESSION['User'] = $this->serialize();
            return true;
        }
    }

    public function changePassword()
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
                $this->changePasswordOnDatabase($newPassword);
                return true;
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
            'email' => $this->email,
            'birth' => $this->birth,
        );
    }

    public static function unserialize($data)
    {
        $user = new self();
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->birth = $data['birth'];
        return $user;
    }
}
