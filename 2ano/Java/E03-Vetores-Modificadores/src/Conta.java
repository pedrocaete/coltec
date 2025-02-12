
public class Conta {

    public static int totalContas;
    private Cliente dono;
    private double saldo;
    private int numero;
    private String agencia;
    private double limite;
    private Operacao[] operacoes = new Operacao[1000];
    private int ultima_operacao = 0;

    public Conta(Cliente dono, double saldo, int numero, String agencia, double limite) {
        totalContas++;
        this.dono = dono;
        this.saldo = saldo;
        this.numero = numero;
        this.agencia = agencia;
        this.limite = limite;
    }
    boolean depositar(double valor) {
        if(valor > 0.0) {
            this.saldo += valor;
            this.operacoes[ultima_operacao] = new Operacao('d',valor);
            this.ultima_operacao ++;
            return true;
        } else {
            return false;
        }
    }


    boolean sacar(double valor) {
        if(valor > 0.0 && valor <= this.saldo) {
            this.saldo -= valor;
            this.operacoes[ultima_operacao] = new Operacao('s',valor);
            this.ultima_operacao ++;
            return true;
        } else {
            return false;
        }
    }


    boolean transferir(Conta contaDestino, double valor) {
        boolean saqueRealizado = this.sacar(valor);
        if(saqueRealizado) {
            boolean depositoRealizado = contaDestino.depositar(valor);
            return depositoRealizado;
        } else {
            return false;
        }
    }


    void imprimirConta(){
        dono.imprimirCliente();
        System.out.println("Número da conta: " + this.numero);
        System.out.println("Saldo: " + this.saldo);
        System.out.println("Limite: " + this.limite);

    }
    void extrato(){
        for(int i = 0; i < this.ultima_operacao; i++) {
            System.out.print(this.operacoes[i].getData() + "  ");
            System.out.print(this.operacoes[i].getTipo() + "  ");
            System.out.print(this.operacoes[i].getValor() + "\n");
        }
    }

    public Cliente getDono(){
        return this.dono;
    }
    public void setDono(Cliente novoDono){
        this.dono = novoDono;
    }

    public int getNumero(){
        return this.numero;
    }

    public void setNumero(int novoNumero){
        this.numero = novoNumero;
    }

    public double getSaldo(){
        return this.saldo;
    }

    public double getLimite(){
        return this.limite;
    }

    public void setLimite(double novoLimite){
        this.limite = novoLimite;
    }
}