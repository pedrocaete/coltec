<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class Database
{
    private static $instance;
    private $pdo;
    const DB = 'sistema';
    const HOST = '172.17.0.2';
    const CHARSET = 'utf8mb4';
    const DSN = "mysql:host=$host;dbname=$db;charset=$charset";
    const USER = 'pedro';
    private $pass = 'pedro';
    const OPTIONS = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    );

    private function __construct()
    {
        try {
            $this->pdo = new PDO(DSN, USER, $this->pass, OPTIONS);
        } catch (PDOException $e) {
            echo 'Erro ao conectar com o BD:' . $e->getMessage();
            exit;
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
