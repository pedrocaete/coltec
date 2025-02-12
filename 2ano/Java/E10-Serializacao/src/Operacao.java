import java.io.Serializable;
import java.util.Date;

/**
 * Classe responsável por registrar operações de saque e depósitos realizados em
 * contas correntes.
 */
public abstract class Operacao implements ITaxas, Comparable<Operacao>, Serializable {

    private Date data;

    private char tipo;

    private double valor;

    public Operacao(char tipo, double valor) {
        this.tipo = tipo;
        this.valor = valor;
        data = new Date();
    }

    @Override
    public String toString() {
        return this.getData() + "  " + this.getTipo() + "  " + this.getValor() + "\n";
    }

    @Override
    public int compareTo(Operacao operacao) {
        if (operacao.tipo == 'd') {
            if (this.tipo == operacao.tipo)
                return this.data.compareTo(operacao.data);
            else
                return 1;
        } else if (operacao.tipo == 's') {
            if (this.tipo == operacao.tipo)
                return this.data.compareTo(operacao.data);
            else
                return -1;
        } else {
            return 0;
        }
    }

    public Date getData() {
        return this.data;
    }

    public char getTipo() {
        return this.tipo;
    }

    public void setTipo(char novoTipo) {
        this.tipo = novoTipo;
    }

    public double getValor() {
        return this.valor;
    }

    public void setValor(double valor) {
        this.valor = valor;
    }
}
