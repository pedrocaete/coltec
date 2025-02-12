
public class Main {

    public static void main(String[] args) {
        Cliente cliente1 = new Cliente();
        cliente1.nome = "Pedro";
        cliente1.cpf = "045594579";
        cliente1.endereco = "Mato da Pampulha";
        cliente1.idade = 78;
        cliente1.sexo= 'M';
        Conta conta1 = new Conta(cliente1, 2000,1234, "222-2", 3500);

        conta1.depositar(900);
        conta1.sacar(2900);

        conta1.extrato();
    }
}
