<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

function connectDB()
{
    $db = 'sistema';
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
