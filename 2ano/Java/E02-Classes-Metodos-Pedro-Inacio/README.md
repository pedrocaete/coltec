# Atividade: Introdução ao Java

Exercícios elaborados pela Profa. Virgínia Fernandes Mota.

## Exercício 01: Reimplementação do sistema

Reimplemente o sistema de internet banking descrito na aula de Classes e Objetos. 
Seu projeto deverá conter duas classes:

* `Conta`, representando a conta corrente, e contendo os mesmos atributos e métodos dados como exemplo durante a aula.
* `Main`, contendo o método principal de execução do programa.

OBS: Voce pode tanto implementar seu próprio código para as funções e atributos quanto copiá-lo do vídeo.

## Exercício 02: Método de Impressão

Implemente um método, denominado `imprimir()`, que realizará a impressão dos dados da conta na tela do usuário. Deverão ser impressos, obrigatoriamente:

* Nome do dono da conta
* Número da conta
* Saldo atual
* Limite

Crie um exemplo de uso do método `imprimir()` no `main()` de seu programa, imprimindo as informações de uma conta qualquer.

## Exercício 03: Classe Cliente

Implemente uma nova classe, denominada `Cliente`, que armazenará os dados dos clientes do banco. Essa classe deverá conter, obrigatoriamente os seguintes atributos:

* Nome (String)
* CPF (String)
* Endereço (String)
* Idade (int)
* Sexo (char, para armazenar 'm' ou 'f')

Você deverá adaptar o seu sistema para essa nova clase. 
Isto é, altere o atributo *dono* da classe `Conta` para que este atributo agora seja do tipo `Cliente`. 
Além disso, você também precisará fazer adaptações no método de impressão.

Crie um exemplo de uso da nova classe no método `main`, atribuindo essa instância a uma conta, e depois invoque o método `imprimir()` para imprimir as informações da conta.