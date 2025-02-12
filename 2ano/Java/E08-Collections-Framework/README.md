# Atividade: Collections

## Exercício 01: Atualizar atributos operacoes

Até o momento, nosso vetor de operações foi implementado utilizando o recurso de vetores. Atualize esse atributo para que ele passe a ser representado por uma lista. Lembre-se de que vc precisa adaptar as demais partes do sistema devido a mudança do tipo da variável vetor de Operações.

## Exercício 02: Opções de extrato

Foi requerido a sua equipe a atualização do método `imprimirExtrato()` de forma que ele forneça a visualização do extrato em duas ordens: (a) padrão, de acordo com a data de inserção na lista; e (b) ordenados pelo seu tipo (primeiro os depósitos, depois os saques).

O tipo de ordenação deverá ser feito por meio de parâmetro do método `imprimirExtrato(int)` por meio de uma flag do tipo `int`.

Para realização da ordenação, utilize o método `Collections.sort()`. Para isso, você precisará implementar a interface `Comparable`.