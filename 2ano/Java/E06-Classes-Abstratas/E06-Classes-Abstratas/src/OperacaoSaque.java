public class OperacaoSaque extends Operacao{

    public OperacaoSaque(double valor){
        super('s',valor);
    }

    public String toString(){
        String s;
        s = (this.getData() + "  ");
        s += ("s  ");
        s += (this.getValor() + "\n");
        return s;
    }
}
