<?php

require_once dirname(__FILE__) . '/../Database.php';
require_once "UserDAO.php";
require_once "User.php";
require_once "UserLogin.php";
require_once dirname(__FILE__) . "/../Form.php";

class UserInfo extends UserLogin
{
    public function __construct()
    {
        session_start();
        $this->restoreFromSession();
    }

    public static function listAll()
    {
        $list = UserDAO::listAll();
        echo "<table border='1'>";
        foreach ($list as $row) {
            echo "<tr>" .
                "<td>" . $row['id'] . "</td>" .
                "<td>" . $row['nome'] . "</td>" .
                "<td>" . $row['email'] . "</td>" .
                "<td>" . $row['acesso'] . "</td>" .
                "</tr>";
        }
        echo "</table>";
    }

    public function alterData()
    {
        if (isset($_POST['submit'])) {
            $this->username = Form::getUsername();
            $this->birth = Form::getBirth();
            $this->email = Form::getEmail();
            UserDAO::alterData($this->username, $this->birth, $this->email, UserDAO::getID($this->email));
            $_SESSION['User'] = $this->serialize();
            return true;
        }
    }

    public function changePassword()
    {
        $newPassword = Form::getNewPassword();
        $confirmPassword = Form::getConfirmPassword();
        if ($newPassword == $confirmPassword) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $confirmPassword = null; //To previne password leaks
            UserDAO::changePassword($newPassword, $this->email);
            return true;
        } else {
            echo '<p style="color:red">Senha de confirmação diverge da nova senha </p>';
        }
    }

    public function remove()
    {
        if (UserDAO::remove($this->email)
        ) {
            echo "Usuário removido com sucesso!";
        } else {
            echo "Erro ao remover usuário";
        }
    }
}
