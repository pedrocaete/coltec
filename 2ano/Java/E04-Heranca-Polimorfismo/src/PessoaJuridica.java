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

    void imprimir(){
        System.out.println("CNPJ: " + this.cnpj);
        System.out.println("Nome: " + this.getNome());
        System.out.println("Endereço: " + this.getEndereco());
        System.out.println("Número de funcionários: " + this.numFuncionarios);
        System.out.println("Setor: " + this.setor);
        System.out.println("Data de criação: " + this.getData());
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

