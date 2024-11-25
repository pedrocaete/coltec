<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "Exceptions/EmptyFieldException.php";

class Form
{

    public static function getField($requiredField)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $field = $_POST[$requiredField];
            if (empty($field)) {
                throw new EmptyFieldException("Campo " . $requiredField . " não pode estar vazio");
            }
            return $field;
        }
    }

    public static function getMonth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $monthAndYear = $_POST['month'];
            if (empty($monthAndYear)) {
                throw new EmptyFieldException("Campo " . $monthAndYear . " não pode estar vazio");
            }
            list($year, $month) = explode('-', $monthAndYear);
            return $month;
        }
    }

    public static function getYear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $monthAndYear = $_POST['month'];
            if (empty($monthAndYear)) {
                throw new EmptyFieldException("Campo " . $monthAndYear . " não pode estar vazio");
            }
            list($year, $month) = explode('-', $monthAndYear);
            return $year;
        }
    }

    public static function getCpf()
    {
        return self::getField("cpf");
    }

    public static function getValue()
    {
        return self::getField("value");
    }

    public static function getDate()
    {
        return self::getField("date");
    }

    public static function getCnpj()
    {
        return self::getField("cnpj");
    }

    public static function getName()
    {
        return self::getField("name");
    }

    public static function getEmail()
    {
        return self::getField("email");
    }

    public static function getPhone()
    {
        return self::getField("phone");
    }

    public static function getPassword()
    {
        return self::getField("password");
    }
}
