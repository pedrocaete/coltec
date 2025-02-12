import java.util.ArrayList;
import java.util.Collections;

public abstract class Conta implements ITaxas {

    public static int totalContas;
    private double saldo;
    private int numero;
    private String agencia;
    protected double limite;
    protected Cliente dono;
    protected ArrayList<Operacao> operacoes = new ArrayList<Operacao>();

    public Conta(double saldo, int numero, String agencia, double limite, Cliente dono) {
        totalContas++;
        this.saldo = saldo;
        this.numero = numero;
        this.agencia = agencia;
        this.limite = limite;
        this.dono = dono;
    }

    boolean depositar(double valor) {
        if (valor > 0.0) {
            this.saldo += valor;
            operacoes.add(new OperacaoDeposito(valor));
            return true;
        } else {
            return false;
        }
    }

    public void imprimirExtratoTaxas() {
        double taxaTotal = this.calculaTaxas();
        System.out.println("=== Extrato de Taxas ===");
        System.out.printf("Manutenção da conta: %.2f \n", this.calculaTaxas());
        System.out.println("\nOperações");
        for (Operacao operacao : operacoes) {
            taxaTotal += operacao.calculaTaxas();
            if (operacao.getTipo() == 's' && operacao.calculaTaxas() != 0)
                System.out.printf("Saque: %.2f\n", operacao.calculaTaxas());
            else if (operacao.getTipo() == 'd' && operacao.calculaTaxas() != 0)
                System.out.printf("Depósito: %.2f\n", operacao.calculaTaxas());
        }
        System.out.printf("\nTotal: %.2f\n", taxaTotal);
    }

    boolean sacar(double valor) {
        if (valor > 0.0 && valor <= this.saldo) {
            this.saldo -= valor;
            operacoes.add(new OperacaoSaque(valor));
            return true;
        } else {
            return false;
        }
    }

    boolean transferir(Conta contaDestino, double valor) {
        boolean saqueRealizado = this.sacar(valor);
        if (saqueRealizado) {
            boolean depositoRealizado = contaDestino.depositar(valor);
            return depositoRealizado;
        } else {
            return false;
        }
    }

    @Override
    public String toString() {
        return "Número: " + this.getNumero() + "\n" +
                "Dono: " + this.dono.getNome() + "\n" +
                "Saldo: " + this.getSaldo() + "\n" +
                "Limite: " + this.getLimite() + "\n";
    }

    @Override
    public boolean equals(Object conta) {
        Conta comp = (Conta) conta;
        return this.getNumero() == comp.getNumero();
    }

    void imprimirExtrato(int ordem) {
        ArrayList<Operacao> operacoes = new ArrayList<Operacao>(this.operacoes);
        switch (ordem) {
            case 0:
                break;
            case 1:
                Collections.sort(operacoes);
                break;
            default:
                System.out.println("Erro. Digite 0 para ordenação por data e 1 para por tipo");
                return;
        }

        for (Operacao operacao : operacoes) {
            System.out.print(operacao.toString());
        }

    }

    public int getNumero() {
        return this.numero;
    }

    public void setNumero(int novoNumero) {
        this.numero = novoNumero;
    }

    public double getSaldo() {
        return this.saldo;
    }

    public double getLimite() {
        return this.limite;
    }

    abstract public void setLimite(double novoLimite);

    public ArrayList<Operacao> getOperacoes() {
        return operacoes;
    }
}
