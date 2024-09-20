<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar Cidades</title>
</head>

<body>
    <form method="post">
            <label for="estado">Selecione um estado: </label>
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
            <input type="submit" name="submit" value="Procurar" style="margin-left:70px"><br><br><br>
    </form>

    <?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    require_once "/var/www/html/semana28/ex1/db_config.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $estado = $_POST['estado'];

        $pdo = connectDB();
        $sql = 'select nome from tb_cidades where uf="' . $estado . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        echo "<table border='1'";
        echo "echo <tr><th>Cidades</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr><td>" . $row[0] . "</td></tr>";
        }
        echo "</table>";
    }
    ?>

</body>


</html>
