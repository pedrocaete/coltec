<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class BookDAO
{
    public function insert($productID, $genre, $numPages){
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO livro (id_produto, genero, num_paginas) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$productID, $genre, $numPages]);
        return $isSuccessful;
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM livro WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function getProductID($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id_produto FROM livro WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $productID = $stmt->execute([$id]);
        return $productID;
    }

    public function getGenre($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT genero FROM livro WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $genre = $stmt->execute([$id]);
        return $genre;
    }

    public function getNumPages($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT num_paginas FROM livro WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $numPages = $stmt->execute([$id]);
        return $numPages;
    }

    public function alterProductID($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE livro SET id_produto = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterGenre($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE livro SET genero = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterNumPages($id){
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE livro SET num_paginas = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM livro";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listByGenre($genre)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM livro WHERE genero = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$genre]);
        return $stmt->fetchAll();
    }

    public function listByNumPagesGreaterThan($numPages)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM livro WHERE num_paginas > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$numPages]);
        return $stmt->fetchAll();
    }
}
