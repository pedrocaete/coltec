public class ContaCorrente extends Conta{

    public ContaCorrente(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    public void setLimite(double novoLimite){
        if (novoLimite < -100)
            System.out.println("Erro. Limite mínimo de R$100");
        else
            limite = novoLimite;
    }
}
