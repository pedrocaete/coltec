public class ContaPoupanca extends Conta {

    public ContaPoupanca(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite) {
        if (novoLimite > 1000) {
            throw new IllegalArgumentException(
                    String.format("Limite Máximo de R$1000.00\tLimite Fornecido: R$%.2f", novoLimite));
        } else if (novoLimite < 100) {
            throw new IllegalArgumentException(
                    String.format("Limite Mínimo de R$100.00\tLimite Fornecido: R$%.2f", novoLimite));
        } else {
            limite = novoLimite;
        }
    }

    @Override
    public double calculaTaxas() {
        return 0;
    }
}
