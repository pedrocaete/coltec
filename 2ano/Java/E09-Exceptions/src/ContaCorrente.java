public class ContaCorrente extends Conta {

    public ContaCorrente(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite) {
        if (novoLimite < -100) {
            throw new IllegalArgumentException(
                    String.format("Limite Mínimo de R$-100.00\tLimite Fornecido: R$%.2f", novoLimite));
        } else {
            limite = novoLimite;
        }

    }

    @Override
    public double calculaTaxas() {
        double taxa;
        if (this.dono instanceof PessoaFisica) {
            taxa = 10;
        } else {
            taxa = 20;
        }
        return taxa;
    }
}
