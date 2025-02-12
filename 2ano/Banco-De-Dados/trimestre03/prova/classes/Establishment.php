<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "Form.php";
require_once "DAO/EstablishmentDAO.php";
require_once dirname(__FILE__) . '/DAO/UserDAO.php';
require_once dirname(__FILE__) . '/DAO/PurchaseDAO.php';
require_once "Exceptions/WrongPasswordException.php";

class Establishment
{
    public $cnpj;
    public $name;
    public $email;
    public $password;

    public function constructByRegister()
    {
        $this->cnpj = Form::getCnpj();
        $this->name = Form::getName();
        $this->email = Form::getEmail();
        $this->password = password_hash(Form::getPassword(), PASSWORD_DEFAULT);
    }

    public function registerOnDatabase()
    {
        EstablishmentDAO::insert($this);
    }

    public function register()
    {
        $this->constructByRegister();
        $this->registerOnDatabase();
    }

    public function login()
    {
        if ($this->verifyPassword()) {
            $this->constructByLogin();
        }
    }

    public function constructByLogin()
    {
        $this->cnpj = Form::getCnpj();
        $this->name = EstablishmentDAO::getName($this->cnpj);
        $this->email = EstablishmentDAO::getEmail($this->cnpj);
        $this->password = EstablishmentDAO::getPassword($this->cnpj);
    }

    public function verifyPassword()
    {
        $cnpj = Form::getCnpj();
        $passwordEntered = Form::getPassword();
        $passwordHash = EstablishmentDAO::getPassword($cnpj);
        if (password_verify($passwordEntered, $passwordHash)) {
            return true;
        } else {
            throw new WrongPasswordException("Senha Incorreta");
        }
    }

    public function listPurchases()
    {
        $purchases = PurchaseDAO::listAllByCnpj($this->cnpj);
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>Data</th>
                        <th scope='col'>Valor</th>
                        <th scope='col'>Cpf Usuário</th>
                        <th scope='col'>Nome Usuário</th>
                    </tr>
                </thead>
                    <tbdody>";
        foreach ($purchases as $purchase) {
            echo "<tr>";
            echo "<td>" . $purchase['data'] . "</td>";
            echo "<td>" . $purchase['valor'] . "</td>";
            echo "<td>" . $purchase['cpf_usuario'] . "</td>";
            echo "<td>" . UserDAO::getName($purchase['cpf_usuario']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>
                </table>";
    }
}
