public class PessoaFisica extends Cliente {

    private String cpf;
    private int idade;
    private char sexo;

    public PessoaFisica(String cpf, int idade, char sexo, String nome, String endereco) {
        super(nome, endereco);
        this.cpf = cpf;
        this.idade = idade;
        this.sexo = sexo;
    }

    @Override
    public String toString() {
        return "CPF: " + this.cpf + "\n" +
                "Nome: " + this.getNome() + "\n" +
                "Endereço: " + this.getEndereco() + "\n" +
                "Idade: " + this.idade + "\n" +
                "Sexo: " + this.sexo + "\n" +
                "Data de criação: " + this.getData() + "\n";
    }

    @Override
    public boolean equals(Object pf) {
        PessoaFisica comp = (PessoaFisica) pf;
        return this.getCpf().equals(comp.getCpf());
    }

    @Override
    public boolean autenticar(String chave) {
        return chave.equals(this.cpf);
    }

    public String getCpf() {
        return cpf;
    }

    public void setCpf(String cpf) {
        this.cpf = cpf;
    }

    public int getIdade() {
        return idade;
    }

    public void setIdade(int idade) {
        this.idade = idade;
    }

    public char getSexo() {
        return sexo;
    }

    public void setSexo(char sexo) {
        this.sexo = sexo;
    }

}
