<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome"><br><br>

            <label for="altura">Altura</label>
            <input type="number" name="altura" id="altura" step="0.01"><br><br>

            <label for="peso">Peso</label>
            <input type="number" name="peso" id="peso" step="1"><br><br>

            <label for="sexo">Sexo</label><br>
            <input type="radio" name="sexo" id="mulher" value="mulher">
            <label for="mulher">Feminino</label><br>
            <input type="radio" name="sexo" id="homem" value="homem">
            <label for="homem">Masculino</label><br>

            <label for="idade">Idade</label>
            <input type="number" name="idade" id="idade" step="1"><br><br>
            <input type="submit" value="Enviar">
        </form>
        <?php
        $nome = $_POST["nome"];
        $altura = $_POST["altura"];
        $peso = $_POST["peso"];
        $sexo = $_POST["sexo"];
        $idade = $_POST["idade"];
        
        $dados = " nome: " . $nome .
        " altura: " . $altura .
        " peso: " . $peso .
        " sexo: ". $sexo .
        " idade: " . $idade;

        $arquivo = fopen("resposta.txt", "w");
        fwrite($arquivo, $dados);
        fclose($arquivo);
        ?>
    </body>
</html>
