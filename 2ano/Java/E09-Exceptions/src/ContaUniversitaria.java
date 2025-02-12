public class ContaUniversitaria extends Conta {

    public ContaUniversitaria(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite) {
        if (novoLimite > 500) {
            throw new IllegalArgumentException(
                    String.format("Limite Máximo de R$500.00\tLimite Fornecido: R$%.2f", novoLimite));
        } else if (novoLimite < 0) {
            throw new IllegalArgumentException(
                    String.format("Limite Mínimo de R$0.00\tLimite Fornecido: R$%.2f", novoLimite));
        } else {
            limite = novoLimite;
        }
    }

    @Override
    public double calculaTaxas() {
        return 0;
    }
}
