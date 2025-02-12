<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class ProductDAO
{
    public function insert($name, $realPrice, $salePrice, $stock, $description, $type, $image)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO produto (nome, preco_real, preco_venda, estoque, descricao, tipo, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$name, $realPrice, $salePrice, $stock, $description, $type, $image]);
        return $isSuccessful;
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function getID($name){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM produto WHERE nome = ?";
        $stmt = $pdo->prepare($sql);
        $name = $stmt->execute([$name]);
        return $name;
    }

    public function getName($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT nome FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $name = $stmt->execute([$id]);
        return $name;
    }

    public function getRealPrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT preco_real FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $realPrice = $stmt->execute([$id]);
        return $realPrice;
    }

    public function getSalePrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT preco_venda FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $salePrice = $stmt->execute([$id]);
        return $salePrice;
    }

    public function getStock($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT estoque FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stock = $stmt->execute([$id]);
        return $stock;
    }

    public function getDescription($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT descricao FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $description = $stmt->execute([$id]);
        return $description;
    }

    public function getType($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT tipo FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $type = $stmt->execute([$id]);
        return $type;
    }

    public function getImage($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT imagem FROM produto WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $image = $stmt->execute([$id]);
        return $image;
    }

    
    public function alterName($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET nome = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterRealPrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET preco_real = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterSalePrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET preco_venda = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterStock($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET estoque = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterDescription($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET descricao = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterType($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET tipo = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function alterImage($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE produto SET imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM produto";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll();
        return $list;
    }
    
    public function listByType($type)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM produto WHERE tipo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type]);
        $list = $stmt->fetchAll();
        return $list;
    }

    public function listByStockGreaterThan($stock)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM produto WHERE estoque > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$stock]);
        $list = $stmt->fetchAll();
        return $list;
    }

    public function listBySalePriceGreaterThan($salePrice)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM produto WHERE preco_venda > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$salePrice]);
        $list = $stmt->fetchAll(); 
        return $list;
    }

    public function listByRealPriceGreaterThan($realPrice){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM produto WHERE preco_real > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$realPrice]);
        $list = $stmt->fetchAll(); 
        return $list;
    }
}
