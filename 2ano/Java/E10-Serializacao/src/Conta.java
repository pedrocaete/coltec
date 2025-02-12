import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.Collections;

public abstract class Conta implements ITaxas, Serializable {

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

    boolean depositar(double valor) throws ValorNegativoException {
        boolean efetuado = false;

        if (valor < 0.0) {
            throw new ValorNegativoException("-- ERRO: Valor Negativo: " + valor);
        } else if (valor > 0.0) {
            this.saldo += valor;
            operacoes.add(new OperacaoDeposito(valor));
            efetuado = true;
        }
        return efetuado;
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

    boolean sacar(double valor) throws ValorNegativoException, LimiteExtravazadoException {
        boolean efetuado = false;

        if (valor < 0.0) {
            throw new ValorNegativoException("-- ERRO: Valor Negativo: " + valor);
        }
        if (valor > this.saldo) {
            throw new LimiteExtravazadoException(
                    "-- ERRO: Limite Extravazado  Valor > Saldo: " + valor + " > " + this.saldo);
        }

        if (valor != 0.0) {
            this.saldo -= valor;
            operacoes.add(new OperacaoSaque(valor));
            efetuado = true;
        }

        return efetuado;
    }

    boolean transferir(Conta contaDestino, double valor) throws LimiteExtravazadoException, ValorNegativoException {
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

    public void imprimirExtrato(int ordem) {
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

    private static String nomeArquivoSerializado(String agencia, int numero) {
        return agencia + "-" + numero + ".ser";
    }

    public void serializar() {
        String nomeArquivo = nomeArquivoSerializado(this.agencia, this.numero);
        try (ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream(nomeArquivo))){
            oos.writeObject(this);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static Conta carregar(String agencia, int numero) {
        String nomeArquivo = nomeArquivoSerializado(agencia, numero);
        try (ObjectInputStream oos = new ObjectInputStream(new FileInputStream(nomeArquivo))) {
            Conta conta = (Conta) oos.readObject();
            return conta;
        } catch (IOException | ClassNotFoundException e) {
            e.printStackTrace();
            return null;
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
