<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class OrderDAO
{
    public function insert($userID, $productsPrice, $freightPrice, $address, $status, $paymentMethod)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO pedido (id_usuario, preco_produtos, preco_frete, endereco, status, forma_pagamento) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt  = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$userID, $productsPrice, $freightPrice, $address, $status, $paymentMethod]);
        return $isSuccessful; 
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful; 
    }

    public function getUserID($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id_usuario FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $userID = $stmt->execute([$id]);
        return $userID;
    }

    public function getProductsPrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT preco_produtos FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $price = $stmt->execute([$id]);
        return $price;
    }

    public function getFreightPrice($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT preco_frete FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $freightPrice = $stmt->execute([$id]);
        return $freightPrice;
    }

    public function getAddress($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT endereco FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $address = $stmt->execute([$id]);
        return $address;
    }

    public function getStatus($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT status FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $status = $stmt->execute([$id]);
        return $status;
    }

    public function getPaymentMethod($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT forma_pagamento FROM pedido WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $paymentMethod = $stmt->execute([$id]);
        return $paymentMethod;
    }

    public function alterUserID($id, $newUserID)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET id_usuario = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $userID = $stmt->execute([$id, $newUserID]);
        return $userID;
    }

    public function alterProductsPrice($id, $newPrice)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET preco_produtos = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newPrice]);
        return $isSuccessful;
    }

    public function alterFreightPrice($id, $newFreightPrice)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET preco_frete = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newFreightPrice]);
        return $isSuccessful;
    }

    public function alterAddress($id, $newAddress)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET endereco = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newAddress]);
        return $isSuccessful;
    }

    public function alterStatus($id, $newStatus)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newStatus]);
        return $isSuccessful;
    }

    public function alterPaymentMethod($id, $newPaymentMethod)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE pedido SET forma_pagamento = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id, $newPaymentMethod]);
        return $isSuccessful;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listByUser($userID)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido WHERE id_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }

    public function listByStatus($status)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido WHERE status = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }

    public function listByDate($date)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido WHERE data = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll();
    }

    public function listByPaymentMethod($paymentMethod)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido WHERE forma_pagamento = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$paymentMethod]);
        return $stmt->fetchAll();
    }

    public funcion listByValueGreaterThan($value){
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM pedido WHERE preco_produtos > ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }
}
