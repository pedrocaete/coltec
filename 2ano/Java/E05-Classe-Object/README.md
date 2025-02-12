# Atividade: A Classe `Object`

Nesta lista daremos continuidade a implementação de nosso sistema bancário. Para isso, você pode (e deve) aproveitar o código desenvolvido nos exercícios anteriores.

## Exercício 01: Implementação do método `toString()`

Até o momento, implementamos um método customizado chamado `imprimir()` para imprimir as informações de todas as classes presentes no sistema.

Chegou a hora de padronizarmos esse processo de impressão! Substitua a declaração dos métodos `imprimir()` pela sobrecarga do método `toString()`, que deverá retornar a representação em `String` do objeto que o invocar. Você deverá implementar esse método para as seguintes classes:

* `ClientePessoaFisica`
* `ClientePessoaJuridica`
* `Conta`
* `OperacaoDeposito`
* `OperacaoSaque`

### Veja um exemplo abaixo:

```java
public class Produto {
	public String nome;
	public int quantidade;
	public double valor;
	
	public String toString() {
		String produtoStr = "Nome: " + this.nome + "\n" +
						 	"Quantidade: " + this.quantidade + "\n" +
						 	"Valor: " + this.valor;
						 
		return produtoStr;
	}
}
```
```java
public class Main {
    public static void main(String[] args) {
        Produto p = new Produto();
        p.nome = "Notebook";
        p.quantidade = 100;
        p.valor = 2500;

        // Tente também System.out.println(p) e veja o que acontece!
        System.out.println(p.toString());
    }
}
```

## Exercício 02: Implementação do método `equals()`

Como observamos na aula, não é possível comparar objetos por meio do operador `==`, uma vez que essa comparação verifica a igualdade dos objetos por sua posição de memória. Para contornar este problema, a linguagem Java forneceu na classe `Object` o método `equals(Object)` para comparar as propriedades de dois objetos quaisquer. Porém, para que a comparação seja feita corretamente, precisamos reimplementar este método para definir quais serão os critérios de igualdade entre eles.

Portanto, você deverá reimplementar o método `equals(Object)` para comparar a igualdade entre as seguintes classes:

* `Conta`: Onde as contas são iguais se elas compartilham do mesmo número
* `ClientePessoaFisica`: Onde os clientes são iguais se eles compartilham do mesmo CPF
* `ClientePessoaJuridica`: Onde os clientes são iguais se eles compartilham do mesmo CNPJ.

