<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once 'Database.php';
class DAO
{
    public static function listAll()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT * FROM `municipios_brasil_populacao_2022_V5`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function listTenMostPopulousCities()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT Municipio FROM `municipios_brasil_populacao_2022_V5` order by Populacao desc limit 10";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listTenMostPopulousCitiesOnState($state)
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "SELECT Municipio FROM `municipios_brasil_populacao_2022_V5` order by Populacao desc limit 10 WHERE Estado = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$state]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createTableWithCapitals()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "CREATE TABLE capitais_estados AS
                SELECT Estado, `Sigla Estado`, Municipio, Populacao
                FROM municipios_brasil_populacao_2022_V5
                WHERE Municipio IN(
                 'Rio Branco', 
                    'Maceió', 
                    'Macapá', 
                    'Manaus', 
                    'Salvador', 
                    'Fortaleza', 
                    'Brasília', 
                    'Vitória', 
                    'Goiânia', 
                    'São Luís', 
                    'Cuiabá', 
                    'Campo Grande', 
                    'Belo Horizonte', 
                    'Belém', 
                    'João Pessoa', 
                    'Curitiba', 
                    'Recife', 
                    'Teresina', 
                    'Rio de Janeiro', 
                    'Natal', 
                    'Porto Alegre', 
                    'Porto Velho', 
                    'Boa Vista', 
                    'Florianópolis', 
                    'São Paulo', 
                    'Aracaju', 
                    'Palmas'   
                );";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public static function createTableWithStates()
    {
        $pdo = Database::getInstance()->getPdo();
        $sql = "CREATE TABLE estados AS
                SELECT DISTINCT Estado, SUM(Populacao)
                FROM municipios_brasil_populacao_2022_V5
                GROUP BY Estado;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
}
