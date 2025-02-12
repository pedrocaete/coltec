# Atividade: Exceptions

## Exercício 01: Tratamento de Saques e depósitos inválidos

Atualmente, nosso programa permite ao usuário a inserção de valores inválidos tanto para saques quanto para depósitos, tais como valores negativos ou superiores ao limite. Você deverá atualizar o programa tratando essas exceções conforme recomendações abaixo:

* **Valor negativo:** Crie uma classe `ValorNegativoException` que seja do tipo checked. Então, lance a exceção para os valores negativos de ambos os métodos `depositar()` e `sacar()`. O tratamento dessas exceções deverá ser feita via `try/catch` no `main` do programa, porém via `throws` nos métodos internos das classes do sistema.

* **Limite insuficiente:** Crie uma classe `SemLimiteException` que seja do tipo checked. Então lance essa exceção para saques de valores fora do limite. O tratamento dessa exceção deverá ser feita via `try/catch` no `main` do programa, porém via `throws` nos métodos internos das classes do sistema.

## Exercício 02: Tratamento do método setLimite

Nosso método `setLimite()` possui um tratamento que define qual limite máximo e mínimo pode ser definido para cada tipo de conta. Porém, nós não definimos nenhum tratamento para quando o usuário fornecer um valor fora do limite.

Atualize o método para que uma exceção seja lançada quando um limite fora da faixa for fornecido. Utilize para isso a exceção `IlegalArgumentException`.