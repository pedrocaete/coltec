<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Cidades</title>
</head>

<body>
    <form method="post">
        <label for="estado">Selecione estado da cidade: </label>
        <select name="estado" id="estado">
            <option value="">Selecione um estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MG">Minas Gerais</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MT">Mato Grosso</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="PR">Paraná</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="SC">Santa Catarina</option>
            <option value="SE">Sergipe</option>
            <option value="SP">São Paulo</option>
            <option value="TO">Tocantins</option>
        </select><br>


        <label for="cidade">Insira o nome da cidade:</label>
        <input type="text" name="cidade" id="cidade">

        <input type="submit" name="submit" value="Inserir Cidade"><br><br><br>
    </form>


    <?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    require_once "/var/www/html/semana28/ex1/db_config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $cidade = $_POST['cidade'];
        $uf = $_POST['estado'];
        $pdo = connectDB();

        $sql = "select distinct e.id from tb_estados e join tb_cidades c on c.id=e.id where e.uf=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uf]);
        $row = $stmt->fetch();
        $estado = $row['id'];

        $sql =  "insert into tb_cidades(estado, uf, nome) values (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$estado, $uf, $cidade]);
        if ($stmt) {
            echo "Dados inseridos!";
        } else {
            echo "Erro ao inserir dados";
        }
    }
    ?>
</body>


</html>
