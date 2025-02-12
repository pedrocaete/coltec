public class Cliente {
    String nome;
    String cpf;
    String endereco;
    int idade;
    char sexo;

    void imprimirCliente(){
        System.out.println("Nome: " + this.nome);
        System.out.println("CPF: " + this.cpf);
        System.out.println("Endereço: " + this.endereco);
        System.out.println("Idade: " + this.idade);
        System.out.println("Sexo: " + this.sexo);
    }
}
