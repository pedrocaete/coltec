# E04: Herança & Polimorfismo

Nesta lista daremos continuidade a implementação de nosso sistema bancário.
Para isso, você pode (e deve) aproveitar o código desenvolvido nos exercícios anteriores.

## 01: Atualização das Operações

A nossa classe `Operacao` é responsável por registrar dois tipos de Operações bancárias: depósito e saque. 
A definição do tipo de Operação é feita por meio de um atributo do tipo caractere, podendo assumir os valores 'd' ou 's'. 
Então, nas operações de depósito nós criamos um novo objeto `new Operacao('d', valor)`, já na operação de saque criamos um objeto `new Operacao('s', valor)`.

Acontece que a implementação dessas operações poderia ser simplificada se utilizarmos os conceitos de Herança e polimorfismo, onde criaremos uma classe pai para todas as Operacoes (`Operacao`), e duas classes filhas representando o saque (`OperacaoSaque`) e depósito (`OperacaoDeposito`). 
Para isso, nós iremos criar três classes, conforme instruções abaixo:

Classe `Operacao`:
- `double valor`: atributo contendo o valor da operação.
- `Date data`: atributo contendo a data da operação.
- `char tipo`: tipo da operação (utilizaremos nas classes filhas)
- `void imprimirExtrato()`: função para imprimir o extrato da operação. você deverá imprimir a frase no formato "DATA \t TIPO \t VALOR".

Classe `OperacaoSaque`, que deverá herdar a classe `Operacao`:
- `OperacaoSaque(double valor)`: construtor que irá receber uma nova instância da classe. Nesse construtor você deverá, necessáriamente, definir `tipo = 's'`, além do atributo `valor` da classe pai (`Operacao`) receber o valor enviado por parâmetro.

Classe `OperacaoDeposito`, que deverá herdar a classe `Operacao`:
- `OperacaoDeposito()`:  construtor que irá receber uma nova instância da classe. Nesse construtor você deverá, necessáriamente, definir `tipo = 'd'`, além do atributo `valor` da classe pai (`Operacao`) receber o valor enviado por parâmetro.


Além disso, você precisará fazer as seguintes mudanças na classe `Conta`:
- Alterar a criação da operação de depósito de forma que seu vetor receba uma nova instância de `OperacaoDeposito`.
- Alterar a criação da operação de saque de forma que seu vetor receba uma nova instância de `OperacaoSaque`.

Após essas mudanças, execute novamente o programa e verifique se o seu sistema continua funcionando normalmente como antes. 
Repare que dessa vez a implementação das operações de saque e depósito ficaram muito mais simples de serem feitas (não é necessário ficar passando caracteres 'd' ou 's' como parâmetro mais).

## 02: Adição de novos tipos de Cliente

Nosso sistema suporta apenas os clientes que possuem CPF, ou seja, são pessoas físicas (PF). 
Porém, em um banco também devemos poder ofertar nossos serviços para instituições; em outras palavras, pessoas jurídicas (PJ).

Pensando nissso, nós vamos estender a classe `Cliente` em nosso sistema de forma que ela passe a suportar tanto PF quanto PJ. 
Para isso, iremos alterar a classe `Cliente` para que ela contenha informações comuns entre PF e PJ, e então criaremos as subclasses `PessoaFisica` e `PessoaJuridica`, conforme instruções abaixo:

classe `Cliente`:
- `String endereco`: atributo para armazenar endereço do cliente
- `String nome`: nome do cliente
- `Date data`: data de criação do cliente
- `void imprimir()`: função para imprimir os dados do Cliente. Deverá imprimir "Cliente inválido".

classe `PessoaFisica`, que herdará de `Cliente`:
- `String cpf`: cpf da PF.
- `int idade`: idade da PF.
- `char sexo`: caractere para denominar o sexo da PF ('m' para masculino, e 'f' para feminino).
- `void imprimir()`: reimplementação do método para impressão dos dados da PF.

classe `PessoaJuridica`:
- `String cnpj`: cpnj da PJ
-  `int numFuncionarios`: Número de funcionários da PJ
-  `String setor`: Setor de atuação da PJ (financeiro, educação, veículos, etc)
-  `void imprimir()`: reimplementação do método para impressão dos dados da PJ.


Faça as adaptações que julgar necessárias para você testar seu programa criando contas que pertençam a PJ e PF.