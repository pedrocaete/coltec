public class PessoaFisica extends Cliente{

    private String cpf;
    private int idade;
    private char sexo;

    public PessoaFisica(String cpf, int idade, char sexo, String nome, String endereco) {
        super(nome, endereco);
        this.cpf = cpf;
        this.idade = idade;
        this.sexo = sexo;
    }

    public String toString(){
	    String s;
        s = ("CPF: " + this.cpf + "\n");
        s += ("Nome: " + this.getNome() + "\n");
        s += ("Endereço: " + this.getEndereco() + "\n");
        s += ("Idade: " + this.idade + "\n");
        s += ("Sexo: " + this.sexo + "\n");
        s += ("Data de criação: " + this.getData() + "\n");
	    return s;
    }

    public boolean equals(Object pf){
        PessoaFisica comp = (PessoaFisica) pf;
        return this.getCpf() == comp.getCpf();
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
