public class OperacaoDeposito extends Operacao {

    public OperacaoDeposito(double valor) {
        super('d', valor);
    }

    @Override
    public String toString() {
        return this.getData() + "  " +
                "d  " +
                this.getValor() + "\n";
    }

    @Override
    public double calculaTaxas() {
        return 0;
    }
}
