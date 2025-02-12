public class OperacaoSaque extends Operacao {

    public OperacaoSaque(double valor) {
        super('s', valor);
    }

    @Override
    public String toString() {
        return this.getData() + "  " + "s  " + this.getValor() + "\n";
    }

    @Override
    public double calculaTaxas() {
        return 0.05;
    }
}
