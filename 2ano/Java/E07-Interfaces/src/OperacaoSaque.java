public class OperacaoSaque extends Operacao implements ITaxas{

    public OperacaoSaque(double valor){
        super('s',valor);
    }

    @Override
    public String toString(){
        String s;
        s = (this.getData() + "  ");
        s += ("s  ");
        s += (this.getValor() + "\n");
        return s;
    }

    @Override
    public double calculaTaxas(){
        return 0.05;
    }
}
