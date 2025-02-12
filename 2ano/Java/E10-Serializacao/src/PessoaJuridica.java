public class PessoaJuridica extends Cliente {

    private String cnpj;
    private int numFuncionarios;
    private String setor;

    public PessoaJuridica(String cnpj, int numFuncionarios, String setor, String nome, String endereco) {
        super(nome, endereco);
        this.cnpj = cnpj;
        this.numFuncionarios = numFuncionarios;
        this.setor = setor;
    }

    @Override
    public String toString() {
        return "CNPJ: " + this.cnpj + "\n" +
                "Nome: " + this.getNome() + "\n" +
                "Endereço: " + this.getEndereco() + "\n" +
                "Número de funcionários: " + this.numFuncionarios + "\n" +
                "Setor: " + this.setor + "\n" +
                "Data de criação: " + this.getData() + "\n";
    }

    @Override
    public boolean equals(Object pj) {
        PessoaJuridica comp = (PessoaJuridica) pj;
        return this.getCnpj().equals(comp.getCnpj());
    }

    @Override
    public boolean autenticar(String chave) {
        return chave.equals(this.cnpj);
    }

    String getCnpj() {
        return cnpj;
    }

    void setCnpj(String cnpj) {
        this.cnpj = cnpj;
    }

    int getNumFUncionarios() {
        return numFuncionarios;
    }

    void setNumFUncionarios(int numFuncionarios) {
        this.numFuncionarios = numFuncionarios;
    }

    String getSetor() {
        return setor;
    }

    void setSetor(String setor) {
        this.setor = setor;
    }
}
