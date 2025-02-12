public class OperacaoDeposito extends Operacao implements ITaxas{

    public OperacaoDeposito(double valor){
        super('d',valor);
    }

    @Override
    public String toString(){
        String s;
        s = (this.getData() + "  ");
        s += ("d  ");
        s += (this.getValor() + "\n");
        return s;
    }

    @Override
    public double calculaTaxas(){
        return 0;
    }
}
