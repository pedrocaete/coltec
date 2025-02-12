public class OperacaoDeposito extends Operacao{

    public OperacaoDeposito(double valor){
        super('d',valor);
    }

    public String toString(){
        String s;
        s = (this.getData() + "  ");
        s += ("d  ");
        s += (this.getValor() + "\n");
        return s;
    }
}
