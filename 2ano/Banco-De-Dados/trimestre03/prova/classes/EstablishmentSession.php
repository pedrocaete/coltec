<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "Establishment.php";

class EstablishmentSession
{
    public $establishment;

    public function __construct(){
        session_start();
    }

    public function createSession($establishment)
    {
        $_SESSION['establishment'] = $establishment;
    }

    public function useSession()
    {
        if (isset($_SESSION['establishment'])) {
            $this->establishment = $_SESSION['establishment'];
        } else {
            $this->establishment = null;
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['establishment']);
    }
}
