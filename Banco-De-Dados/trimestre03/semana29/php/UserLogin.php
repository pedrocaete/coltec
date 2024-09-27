<?php

require_once "../database/db_config.php";
require_once "UserDAO.php";
require_once "User.php";
require_once "Form.php";

class UserLogin extends User
{
    public function __construct()
    {
        $this->email = Form::getEmail();
        $this->password = password_hash(Form::getPassword(), PASSWORD_DEFAULT);
    }

    private function verifyUser()
    {
        $password = Form::getPassword();
        if (UserDAO::exists($this->email, $this->pdo)) {
            if ($this->checkPassword($password)) {
                return true;
            } else {
                echo "Senha incorreta";
            }
        } else {
            echo "Usuário inexistente";
        }
    }

    public function checkPassword($passwordGived)
    {
        $userPassword = UserDAO::getPassword($this->email);
        if (password_verify($passwordGived, $userPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        if ($this->verifyUser()) {
            $this->getData();
            $this->startSession();
            echo "Logado";
            return true;
        }
    }

    public function getData(){
        $data = UserDAO::getData($this->email);
        $this->username = $data['nome'];
        $this->password =$data['senha'];
        $this->email =$data['email'];
        $this->birth =$data['nascimento'];
        $this->acesso =$data['acesso'];
        $this->id = $data['id'];
    }

}
