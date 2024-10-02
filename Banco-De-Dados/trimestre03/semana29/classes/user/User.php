<?php

require_once dirname(__FILE__) . '/../Database.php';
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
            'status' => $this->status,
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
        $user->status = $data['status'];
        return $user;
    }

    public function restoreFromSession()
    {
        if (isset($_SESSION['User'])) {
            $data = $_SESSION['User'];
            $this->username = $data['username'];
            $this->password = $data['password'];
            $this->email = $data['email'];
            $this->birth = $data['birth'];
            $this->id = $data['id'];
            $this->acesso = $data['acesso'];
            $this->status = $data['status'];
        }
    }

    public function startSession()
    {
        session_start();
        $_SESSION['User'] = $this->serialize();
    }

    public function isActive()
    {
        return UserDAO::getStatus($this->email) == "ativo" ? true : false;
    }
}
