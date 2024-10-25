<?php
require_once dirname(__FILE__) . '/../Database.php';
require_once "UserDAO.php";
require_once "User.php";
require_once dirname(__FILE__) . "/../Form.php";

class UserRegister extends User
{
    public function __construct()
    {
        $this->username = Form::getUsername();
        $this->password = password_hash(Form::getPassword(), PASSWORD_DEFAULT);
        $this->email = Form::getEmail();
        $this->birth = Form::getBirth();
        $this->acesso = Form::getAcesso();
        $this->status = UserDAO::getStatus($this->email);
    }

    public function register()
    {
        if (UserDAO::exists($this->email)) {
            echo "Já há um usuário associado a este email";
        } else {
            UserDAO::insert($this->username, $this->email, $this->password, $this->birth, $this->acesso);
            $this->startSession();
            return true;
        }
    }
}
