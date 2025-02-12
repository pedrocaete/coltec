
public class Main {

    public static void main(String[] args) {
        Conta conta1 = new Conta();
        Cliente cliente1 = new Cliente();
        cliente1.nome = "Pedro";
        cliente1.cpf = "045594579";
        cliente1.endereco = "Mato da Pampulha";
        cliente1.idade = 78;
        cliente1.sexo= 'M';
        conta1.dono = cliente1;
        conta1.agencia = "222-2";
        conta1.numero = 1234;
        conta1.saldo = 2000;
        conta1.limite = 3500;

        Conta conta2 = new Conta();
        conta2 = conta1;

        conta1.imprimirConta();

        if(conta1 == conta2) {
            System.out.println("Iguais");
        } else {
            System.out.println("Diferentes");
        }
    }
}

