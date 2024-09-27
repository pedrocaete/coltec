<?php

require_once "../database/db_config.php";
require_once "UserDAO.php";

abstract class User
{
    public $username;
    public $password;
    public $email;
    public $birth;
    public $acesso;
    public $id;
    public $status;

    public function serialize()
    {
        return array(
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'birth' => $this->birth,
            'id' => $this->id,
            'acesso' => $this->acesso,
        );
    }

    public static function unserialize($data)
    {
        $user = new self();
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->birth = $data['birth'];
        $user->id = $data['id'];
        $user->acesso = $data['acesso'];
        return $user;
    }

    public function startSession()
    {
        session_start();
        $_SESSION['User'] = $this->serialize();
    }
}
