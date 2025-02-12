
public abstract class Conta implements ITaxas{

    public static int totalContas;
    private double saldo;
    private int numero;
    private String agencia;
    protected double limite;
    protected Cliente dono;
    protected Operacao[] operacoes = new Operacao[1000];
    protected int ultima_operacao = 0;

    public Conta(double saldo, int numero, String agencia, double limite, Cliente dono) {
        totalContas++;
        this.saldo = saldo;
        this.numero = numero;
        this.agencia = agencia;
        this.limite = limite;
        this.dono = dono;
    }
    boolean depositar(double valor) {
        if(valor > 0.0) {
            this.saldo += valor;
            this.operacoes[ultima_operacao] = new OperacaoDeposito(valor);
            this.ultima_operacao ++;
            return true;
        } else {
            return false;
        }
    }

    public void imprimirExtratoTaxas() {
	double taxaTotal = this.calculaTaxas();
        System.out.println("=== Extrato de Taxas ===");
        System.out.printf("Manutenção da conta: %.2f \n" ,this.calculaTaxas());
        System.out.println("\nOperações");
        for (int i = 0; i < this.getUltima_operacao(); i ++) {
	    taxaTotal += this.getOperacoes()[i].calculaTaxas();
            if(this.getOperacoes()[i].getTipo() == 's' && this.getOperacoes()[i].calculaTaxas() != 0)
                System.out.printf("Saque: %.2f\n", this.getOperacoes()[i].calculaTaxas());
            else if(this.getOperacoes()[i].getTipo() == 'd' && this.getOperacoes()[i].calculaTaxas() != 0)
                System.out.printf("Depósito: %.2f\n", this.getOperacoes()[i].calculaTaxas());
        }
	System.out.printf("\nTotal: %.2f\n",taxaTotal);
    }

    boolean sacar(double valor) {
        if(valor > 0.0 && valor <= this.saldo) {
            this.saldo -= valor;
            this.operacoes[ultima_operacao] = new OperacaoSaque(valor);
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


    public String toString() {
	String s;
        s = ("Número: " + this.getNumero() + "\n");
        s += ("Dono: " + this.dono.getNome() + "\n");
        s += ("Saldo: " + this.getSaldo() + "\n");
        s += ("Limite: " + this.getLimite() + "\n");
    	return s;
    }

    public boolean equals(Object conta){
        Conta comp = (Conta) conta;
        return this.getNumero() == comp.getNumero();
    }

    void extrato(){
        for(int i = 0; i < this.ultima_operacao; i++) {
            System.out.print(this.operacoes[i].toString());
        }
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

    abstract public void setLimite(double novoLimite);

    public int getUltima_operacao() { return this.ultima_operacao; }

    public Operacao[] getOperacoes() { return operacoes; }
}
