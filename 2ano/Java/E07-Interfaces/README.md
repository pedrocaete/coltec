# Atividade: Interfaces


## Exercício 01: Interface `ITaxas`

Muito do lucro dos bancos vem das taxas cobradas pela execução de seus serviços. Essas taxas são aplicadas nas mais diversas situações, como manutenção de conta, e recebimento/envio de valores.

Implemente uma interface chamada `ITaxas` que contenha a declaração do método `calculaTaxas()`. Esse método deverá retornar um valor do tipo `double` contendo o valor da taxa paga para realização daquele serviço.

## Exercício 02: Implementando os mecanismos de tributação

Uma vez criada a interface, relacione-a com as classes cujo serviços sofrerão tributação. Mais especificamente, você deverá implementar essa interface para as classes abaixo:

* `ContaCorrente`: Taxar em 10 reais se cliente for uma pessoa física, ou 20 reais se pessoa jurídica.
* `ContaPoupanca`: Não cobra taxa (0 reais)
* `ContaUniversitaria`: Não cobra taxa (0 reais)
* `OperacaoDeposito`: Não cobra taxa (0 reais)
* `OperacaoSaque`: 5 centavos por saque

## Exercício 03: Extrato de Taxas

Implemente um método na classe `Conta` chamado `imprimirExtratoTaxas()` que irá, para uma determinada conta, imprimir todas as taxas já incidentes resultantes da sua movimentação. Ao final, você ainda deverá imprimir o valor total das taxas cobradas. Veja um exemplo desse extrato abaixo:

```java
public static void main(String[] args) {
    // Criando um cliente que é uma pessoa física
    Cliente pessoa = new ClientePessoaFisica(...);
    
    // Criando uma conta corrente para esse cliente
    Conta cc = new ContaCorrente(...);
    cc.setCliente(pessoa);
    
    //Fazendo operações de saques e depósitos
    cc.depositar(1000);
    cc.depositar(2000);
    cc.sacar(500)
    cc.depositar(3000);
    cc.sacar(10);
    cc.sacar(15);
    
    cc.imprimirExtratoTaxas();
}
```

A saída deverá ser algo como:
```
=== Extrato de Taxas ===
Manutenção da conta: 10.0

Operações
Saque: 0.05
Saque: 0.05
Saque: 0.05

Total: 10.15
```


