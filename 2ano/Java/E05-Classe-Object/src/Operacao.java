import java.util.Date;

/**
 * Classe responsável por registrar operações de saque e depósitos realizados em contas correntes.
 */
public class Operacao {

    public static int totalOperacoes;

    private Date data;

    private char tipo;

    private double valor;

    public Operacao(char tipo, double valor) {
        this.tipo = tipo;
        this.valor = valor;
        data = new Date();
        totalOperacoes++;
    }

    public String toString(){
    	String s;
        s = (this.getData() + "  ");
        s += (this.getTipo() + "  ");
        s += (this.getValor() + "\n");
    	return s;
    }

    public Date getData(){
        return this.data;
    }

    public char getTipo(){
        return this.tipo;
    }

    public void setTipo(char novoTipo){
        this.tipo = novoTipo;
    }

    public double getValor(){
        return this.valor;
    }

    public void setValor(double valor){
        this.valor = valor;
    }
}
