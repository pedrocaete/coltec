<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once "Form.php";
require_once dirname(__FILE__) . '/DAO/PurchaseDAO.php';
require_once dirname(__FILE__) . '/DAO/EstablishmentDAO.php';

class Purchase
{
    public $id;
    public $date;
    public $value;
    public $user_cpf;
    public $establishment_cnpj;

    public function constructByRegister($user)
    {
        $this->date = Form::getDate();
        $this->value = Form::getValue();
        $this->establishment_cnpj = Form::getCnpj();
        $this->user_cpf = $user->cpf;
    }

    public function registerOnDatabase()
    {
        PurchaseDAO::insert($this);
    }

    public function register($user)
    {
        $this->constructByRegister($user);
        $this->registerOnDatabase();
    }

    public static function listSalesOnPeriod($intialDate, $finalDate)
    {
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th scope='col'>Vendas Totais</th>
                    </tr>
                </thead>
                    <tbdody>";
        echo "<tr>";
        echo "<th>" . $intialDate . " a " . $finalDate . "</th>";
        echo "<td>" . PurchaseDAO::listTotalValueByTimePeriod($intialDate, $finalDate) . "</td>";
        echo "</tr>";
        echo "</tbody>
                </table>";
    }
}
