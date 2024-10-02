<?php
class Form
{
    public static function getUsername()
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

    public static function getPassword()
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

    public static function getEmail()
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

    public static function getBirth()
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

    public static function getAcesso()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $acesso = $_POST['acesso'];
            if (empty($acesso)) {
                echo '<p style="color:red">Preencha todos os campos</p>';
                exit;
            }
            return $acesso;
        }
    }

    public static function getNewPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $newPassword = $_POST['newPassword'];
            if (empty($newPassword)) {
                echo '<p style="color:red">A senha precisa de no mínimo 1 caractere</p>';
                exit;
            }
            return $newPassword;
        }
    }
    public static function getConfirmPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $confirmPassword = $_POST['confirmPassword'];
            if (empty($confirmPassword)){
                echo '<p style="color:red">Digite a senha de confirmação</p>';
                exit;
            }
            return $confirmPassword;
        }
    }
}
