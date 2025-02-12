<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "User.php";

class UserSession
{
    public $user;

    public function __construct(){
        session_start();
    }

    public function createSession($user)
    {
        $_SESSION['user'] = $user;
    }

    public function useSession()
    {
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        } else {
            $this->user = null;
        }
    }

    public function destroySession($user)
    {
    }

    public function isLoggedIn()
    {

        return isset($_SESSION['user']);
    }
}
