<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


define('HOST', '172.17.0.2');
define('DB', 'CidadeEstado');
define('CHARSET', 'utf8mb4');
define('DSN', 'mysql:host=' . HOST . ';dbname=' . DB . ';charset=' . CHARSET);
define('USER', 'pedro');
define('PASSWORD', 'pedro');
define('OPTIONS', []);


function connectDB()
{
    $db = 'CidadeEstado';
    $host = '172.17.0.2';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $user = 'pedro';
    $pass = 'pedro';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    );
    try {
        $conn = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo 'Erro ao conectar com o BD:' . $e->getMessage();
        exit;
    }
    return $conn;
}
