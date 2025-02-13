<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class OrderProductDAO
{
    public function insert($orderID, $productID, $productQuantity)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO pedido_produto (id_pedido, id_produto, quantidade_produto) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$orderID, $productID, $productQuantity]);
        return $isSuccessful;
    }

    public function deleteProduct($orderID, $productID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM pedido_produto WHERE id_pedido = ? AND id_produto = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$orderID, $productID]);
        return $isSuccessful;
    } 

    public function deleteOrder($orderID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM pedido_produto WHERE id_pedido = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$orderID]);
        return $isSuccessful;
    }

    public function getProductQuantity($orderID, $productID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT quantidade_produto FROM pedido_produto WHERE id_pedido = ? AND id_produto";
        $stmt = $pdo->prepare($sql);
        $productQuantity = $stmt->execute([$orderID, $productID]);
        return $productQuantity;
    }

    public function alterProductQuantity($orderID, $productID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido_produto SET quantidade_produto = ? WHERE id_pedido = ? AND id_produto";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$orderID, $productID]);
        return $isSuccessful;
    }

    public function listAll(){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido_produto";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $$stmt->fetchAll();
        return $name;
    }

    public function listByOrderID($orderID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido_produto WHERE id_pedido = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderID]);
        $list = $stmt->fetchAll();
        return $list;
    }

    public function listByProductID($productID){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido_produto WHERE id_produto = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$productID]);
        $list = $stmt->fetchAll();
        return $list;
    }

}
