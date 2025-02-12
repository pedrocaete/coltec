<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'a2023951431@teiacoltec.org');
define('DB_USER', 'a2023951431@teiacoltec.org');
define('DB_PASS', '@Coltec2024');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
