<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class Database
{
    private static $instance;
    private $pdo;
    private $db = 'a2023951431@teiacoltec.org';
    private $host = 'localhost';
    private $charset = 'utf8mb4';
    private $dsn; 
    private $user = 'a2023951431@teiacoltec.org';
    private $pass = '@Coltec2024';
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    );

    private function __construct()
    {
        $this->dsn= "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
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
