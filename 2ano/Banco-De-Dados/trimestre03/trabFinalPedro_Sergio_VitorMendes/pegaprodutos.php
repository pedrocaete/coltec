<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();
include 'config.php';

try {
    $stmt = $pdo->query("SELECT 
    p.id as id, floor(rand()*6) as rating, p.preco_venda as preco, p.nome as nome, p.descricao as 'desc', p.imagem as image, p.tipo as categoria, l.genero as genero 
    FROM produto p
    LEFT JOIN livro l ON p.id = l.id_produto");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['produtos'] = $produtos;
} catch (Exception $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}
?>