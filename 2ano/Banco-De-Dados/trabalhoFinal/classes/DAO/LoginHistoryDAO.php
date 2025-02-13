<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class LoginHistoryDAO
{

    function insert($idLogin, $date)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO historico_logins (id_login, data) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idLogin, $date]);
        return $stmt;
    } 

    function alterDate($newDate, $id)
    {
        $pdo = Database::getInstace()->getPdo();
        $sql = "UPDATE historico_logins SET data = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute[($newDate, $id)];
        return $isSuccessful;
    }

    function alterIDLogin($newIDLogin, $id)
    {
        $pdo = Database::getInstace()->getPdo();
        $sql = "UPDATE historico_logins SET id_login = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute[($newIDLogin, $id)];
        return $isSuccessful;
    }

    function listByUser($idLogin)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM historico_logins WHERE id_login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idLogin]);
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }

    function listByDate($date)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM historico_logins WHERE data = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date]);
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM historico_logins";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }
}
