<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "Form.php";
require_once dirname(__FILE__) . '/DAO/UserDAO.php';
require_once dirname(__FILE__) . '/DAO/PurchaseDAO.php';
require_once dirname(__FILE__) . '/DAO/EstablishmentDAO.php';
require_once "Exceptions/WrongPasswordException.php";

class User
{
    public $cpf;
    public $name;
    public $email;
    public $phone;
    public $password;

    public function register()
    {
        $this->constructByRegister();
        $this->registerOnDatabase();
    }

    public function constructByRegister()
    {
        $this->cpf = Form::getCpf();
        $this->name = Form::getName();
        $this->email = Form::getEmail();
        $this->phone = Form::getPhone();
        $this->password = password_hash(Form::getPassword(), PASSWORD_DEFAULT);
    }

    public function registerOnDatabase()
    {
        UserDAO::insert($this);
    }

    public function login()
    {
        if ($this->verifyPassword()) {
            $this->constructByLogin();
        }
    }

    public function constructByLogin()
    {
        $this->cpf = Form::getCpf();
        $this->name = UserDAO::getName($this->cpf);
        $this->email = UserDAO::getEmail($this->cpf);
        $this->phone = UserDAO::getPhone($this->cpf);
        $this->password = UserDAO::getPassword($this->cpf);
    }

    public function verifyPassword()
    {
        $cpf = Form::getCpf();
        $passwordEntered = Form::getPassword();
        $passwordHash = UserDAO::getPassword($cpf);
        if (password_verify($passwordEntered, $passwordHash)) {
            return true;
        } else {
            throw new WrongPasswordException("Senha Incorreta");
        }
    }

    public function listPurchases()
    {
        $purchases = PurchaseDAO::listAllByCpf($this->cpf);
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>Data</th>
                        <th scope='col'>Valor</th>
                        <th scope='col'>Cnpj Estabelecimento</th>
                        <th scope='col'>Nome Estabelecimento</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($purchases as $purchase) {
            echo "<tr>";
            echo "<td>" . $purchase['data'] . "</td>";
            echo "<td>" . $purchase['valor'] . "</td>";
            echo "<td>" . $purchase['cnpj_estabelecimento'] . "</td>";
            echo "<td>" . EstablishmentDAO::getName($purchase['cnpj_estabelecimento']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }

    public function getTotalPurchasesValueOnMonth($month)
    {
        $purchases = PurchaseDAO::listAllByCpf($this->cpf);
        foreach ($purchases as $purchase) {
        }
    }

    public static function listPurchasesByTimePeriod($cpf, $initialDate, $finalDate)
    {
        $table = PurchaseDAO::listAllByCpfAndTimePeriod($cpf, $initialDate, $finalDate);
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Data</th>
                        <th scope='col'>Valor</th>
                        <th scope='col'>Estabelecimento</th>
                        <th scope='col'>Cnpj Estabelecimento</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($table as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['valor'] . "</td>";
            echo "<td>" . EstablishmentDAO::getName($row['cnpj_estabelecimento']) . "</td>";
            echo "<td>" . $row['cnpj_estabelecimento'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }

    public function getData()
    {
        echo "<div class='user-data'>";
        echo "<h2>Dados do Usuário</h2>";
        echo "<p><strong>CPF:</strong> " . htmlspecialchars($this->cpf) . "</p>";
        echo "<p><strong>Nome:</strong> " . htmlspecialchars($this->name) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($this->email) . "</p>";
        echo "<p><strong>Telefone:</strong> " . htmlspecialchars($this->phone) . "</p>";
        echo "<p><strong>Pontos:</strong> " . (UserDAO::getPoints($this->cpf)) . "</p>";
        echo "</div>";
    }

    public static function getDataByCpf($cpf)
    {
        echo  "<div class='user-data'>";
        echo  "<h2>Dados do Usuário</h2>";
        echo  "<p><strong>CPF:</strong> " . htmlspecialchars($cpf) . "</p>";
        echo  "<p><strong>Nome:</strong> " . htmlspecialchars(UserDAO::getName($cpf)) . "</p>";
        echo  "<p><strong>Email:</strong> " . htmlspecialchars(UserDAO::getEmail($cpf)) . "</p>";
        echo  "<p><strong>Telefone:</strong> " . htmlspecialchars(UserDAO::getPhone($cpf)) . "</p>";
        echo  "<p><strong>Pontos:</strong> " . (UserDAO::getPoints($cpf)) . "</p>";
        echo  "</div>";
    }

    public static function sortUser()
    {
        $users = UserDAO::getAllUsersWithPoints(); // Método que deve retornar todos os usuários com seus pontos
        $totalPoints = 0;

        foreach ($users as $user) {
            $totalPoints += $user['pontos'];
        }

        // Realizar o sorteio
        $randomPoint = rand(0, $totalPoints - 1);
        $currentPoint = 0;

        foreach ($users as $user) {
            $currentPoint += $user['pontos'];
            if ($currentPoint > $randomPoint) {
                return $user;
            }
        }

        return null; // Caso não encontre nenhum usuário (deve ser improvável)
    }
}
