<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once dirname(__FILE__) . '/../Database.php';

class EmployeeExpensesDAO
{
    public function insert($idEmployee, $date, $value, $description)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "INSERT INTO gastos_funcionario (id_funcionario, data, valor, descricao) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$idEmployee, $date, $value, $description]);
        return $isSuccessful;
    }

    public function delete($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "DELETE FROM gastos_funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$id]);
        return $isSuccessful;
    }

    public function getUserID($email)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id FROM login WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $id = $stmt->execute([$email]);
        return $id;
    }
    public function getEmployeeID($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT id_funcionario FROM gastos_funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $employeeID = $stmt->execute([$id]);
        return $employeeID
    }

    public function getDate($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT data FROM gastos_funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $date = $stmt->execute([$id]);
        return $date
    }

    public function getValue($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT valor FROM gastos_funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $value = $stmt->execute([$id]);
        return $value
    }

    public function getDescription($id)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT descricao FROM gastos_funcionario WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $description = $stmt->execute([$id]);
        return $description
    }

    public function alterDate($id, $newDate)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE gastos_funcionario SET data = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$newDate, $id]);
        return $isSuccessful;
    }

    public function alterValue($id, $newValue)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE gastos_funcionario SET valor = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$newValue, $id]);
        return $isSuccessful;
    }

    public function alterDescription($id, $newDescription)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "UPDATE gastos_funcionario SET descricao = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $isSuccessful = $stmt->execute([$newDescription, $id]);
        return $isSuccessful;
    }

    public function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM gastos_funcionario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listByEmployee($employeeID)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM gastos_funcionario WHERE id_funcionario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listByDate($date)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM gastos_funcionario WHERE data = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date]);
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listByValue($value)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM gastos_funcionario WHERE valor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

}
