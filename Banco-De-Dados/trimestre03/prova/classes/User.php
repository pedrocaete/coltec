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

    public function login() {
        if($this->verifyPassword()){
           $this->constructByLogin(); 
        }
    }

    public function constructByLogin(){
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
}
