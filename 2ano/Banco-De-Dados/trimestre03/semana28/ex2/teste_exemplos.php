<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teste Exemplos</title>
</head>

<body>
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once '../ex1/db_config.php';

echo "<h1>Exemplo1</h1>";

$pdo = connectDB();
$sql = 'SELECT nome, uf FROM estados;';
$stmt = $pdo->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch()) {
    echo  $row[0] . " | " . $row[1] . " | " . "
";
}

echo "<h1>Exemplo2</h1>";

$sql = 'SELECT nome, uf FROM estados limit 5;';
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_BOTH);
$stmt->execute();
while ($row = $stmt->fetch())
{
    echo $row[0]." = ".$row[1]. "
";
    echo $row['nome']." = ".$row['uf']. "
";

}


echo "<h1>Exemplo3</h1>";

$sql = 'SELECT nome, uf FROM estados limit 5;';
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch())
{
    echo $row['nome']." = ".$row['uf']. "
";

}

echo "<h1>Exemplo4</h1>";

$sql = 'SELECT nome, uf FROM estados limit 5;';
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
while ($row = $stmt->fetch())
{
    echo $row->nome." = ".$row->uf. "
";

}

echo "<h1>Exemplo5</h1>";

class estados {
    public $nome;
    public $uf;
}

$sql = 'SELECT nome, uf FROM estados limit 5;';
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_CLASS, 'estados');
$stmt->execute();

while ($obj=$stmt->fetch()){
    echo $obj->nome. " = ". $obj->uf;
    echo "
";
}

?>
</body>

</html>
