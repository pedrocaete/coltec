# Atividade: Classes Abstratas

## Exercício 01: Tornando `Cliente` e `Operacao` em classes abstratas

No contexto do nosso sistema bancário, não faz sentido permitir que o desenvolvedor faça inicializações das classes `Cliente`e `Operacao` diretamente. Em outras palavras, a linha abaixo deveria ser coibida em nosso programa:

```java
Cliente c = new Cliente(); //ISSO NÃO DEVERIA SER POSSÍVEL!
Operacao op = new Operacao('s', 1000); // ISSO TAMBÉM NÃO!!
```

Nós sabemos que o recurso de **classes abstratas** impede que a classe definida como abstrata seja diretamente declarada em nosso programa. Portanto, você deverá alterar a estrutura do sistema Internet Banking para que tanto `Cliente` quanto `Operacao` sejam abstratas. Faça as adaptações necessárias  para que essa alteração mantenha o programa em funcionamento .

## Exercício 02: O método `autenticar(String)`

Declare um método abstrato na classe `Cliente` que faça a autenticação dos clientes pessoas físicas e jurídicas conforme sua necessidade. Esse método deverá retornar um valor do tipo `boolean`, onde `true` representa a autenticação feita corretamente, e `false` uma autenticação incorreta. Ainda, esse método deverá receber como parâmetro uma `String`, contendo a chave que será utilizada na autenticação.

Mais especificamente, a autenticação deverá ocorrer da seguinte forma:
* `ClientePessoaFisica`: A autenticação deverá comparar se a chave é igual ao CPF.
* `ClientePessoaJuridica`: A autenticação deverá comparar se a chave é igual ao CNPJ.

**Dica:** O vídeo da aula pode ter informações muito relevantes!

## Exercício 03: Criando novos tipos de Conta

Em um banco, pode haver diversos tipos distintos de conta, como Conta Corrente, Conta Poupança, Conta Universitária, etc. Essas contas possuem particularidades, especialmente com relação a taxa praticada durante o saque de valores.

Você deverá estender o Sistema de Internet Banking para que ele suporte a criação de `ContaCorrente`, `ContaPoupanca` e `ContaUniversitaria`. Todas essas contas deverão herdar suas características de `Conta`. Além disso, você deverá tornar a classe `Conta` abstrata, para que nenhum outro desenvolvedor a instancie diretamente.

Também foi decidido que cada tipo de conta terá uma regra específica para definição do limite máximo, variando de acordo com a conta. Naturalmente, o método responsável por essa customização deverá ser obrigatóriamente implementado em toda subclasse que herdar as características de `Conta`.

Você deverá atualizar o método `setLimite(double)` para que ele atenda as condições definidas acima. Em outras palavras, você deverá torná-lo um método abstrato. Por fim, você deverá implementar o comportamento desse método abstrato para cada uma das três novas contas criadas, conforme restrições abaixo:
* `ContaCorrente`: Sem limite máximo e no máximo -100 reais de limite mínimo.
* `ContaPoupanca`: Limite máximo de 1000 reais, e limite mínimo de 100 reais.
* `ContaUniversitaria`: Limite máximo de 500 reais e limite mínimo de 0 reais.

