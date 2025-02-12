
public class Main {

    public static void main(String[] args) {
        Cliente cliente1 = new PessoaFisica("123456789", 30, 'M', "João da Silva", "Rua XYZ, 123");
        Conta conta1 = new ContaCorrente(1006660.0, 123456, "001", 500.0, cliente1);

        conta1.serializar();
        Conta contacarreagada = Conta.carregarSerializacao("001", 123456);
        
        if (conta1.equals(contacarreagada)){
            System.out.println("A conta foi carregada corretamente");
        }
    }
}
