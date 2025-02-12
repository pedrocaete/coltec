import java.util.Objects;

public class ContaCorrente extends Conta implements ITaxas{

    public ContaCorrente(double saldo, int numero, String agencia, double limite, Cliente dono) {
        super(saldo, numero, agencia, limite, dono);
    }

    @Override
    public void setLimite(double novoLimite){
        if (novoLimite < -100)
            System.out.println("Erro. Limite mínimo de R$100");
        else
            limite = novoLimite;
    }

    @Override
    public double calculaTaxas(){
        double taxa;
        if (this.dono instanceof PessoaFisica){
            taxa = 10;
        }
        else{
            taxa = 20;
        }
        return taxa;
    }
}
