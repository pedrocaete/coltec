public class ContaPoupanca extends Conta{

    public ContaPoupanca(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite){
        if (novoLimite > 1000)
            System.out.println("Erro. Limite máximo de R$1000");
        else if (novoLimite < 100)
            System.out.println("Erro. Limite mínimo de R$100");
        else
        limite = novoLimite;
    }
}
