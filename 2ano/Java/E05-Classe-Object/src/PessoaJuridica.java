public class PessoaJuridica extends Cliente{

    private String cnpj;
    private int numFuncionarios;
    private String setor;

    public PessoaJuridica(String cnpj, int numFuncionarios, String setor, String nome, String endereco){
        super(nome, endereco);
        this.cnpj = cnpj;
        this.numFuncionarios = numFuncionarios;
        this.setor = setor;
    }

    public String toString(){
	String s;
        s = ("CNPJ: " + this.cnpj + "\n");
        s += ("Nome: " + this.getNome() + "\n");
        s += ("Endereço: " + this.getEndereco() + "\n");
        s += ("Número de funcionários: " + this.numFuncionarios + "\n");
        s += ("Setor: " + this.setor + "\n");
        s += ("Data de criação: " + this.getData() + "\n");
    	return s;
    }

    public boolean equals(Object pj){
        PessoaJuridica comp = (PessoaJuridica) pj;
        return this.getCnpj() == comp.getCnpj();
    }


    String getCnpj(){
        return cnpj;
    }

    void setCnpj(String cnpj){
        this.cnpj = cnpj;
    }

    int getNumFUncionarios(){
        return numFuncionarios;
    }

    void setNumFUncionarios(int numFuncionarios){
        this.numFuncionarios = numFuncionarios;
    }

    String getSetor(){
        return setor;
    }

    void setSetor(String setor){
        this.setor = setor;
    }
}

