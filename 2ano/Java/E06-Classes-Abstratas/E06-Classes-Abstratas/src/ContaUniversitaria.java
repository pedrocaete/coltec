public class ContaUniversitaria extends Conta{

    public ContaUniversitaria(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite){
        if (novoLimite > 500)
            System.out.println("Erro. Limite máximo de R$500");
        else if (novoLimite < 0)
            System.out.println("Erro. Limite máximo de R$0");
        else
            limite = novoLimite;
    }
}
