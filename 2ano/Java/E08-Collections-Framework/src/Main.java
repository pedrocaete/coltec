
public class Main {

    public static void main(String[] args) {
        Cliente pessoa1 = new PessoaFisica("123456789", 30, 'M', "João da Silva", "Rua XYZ, 123");
        Cliente empresa1 = new PessoaJuridica("12345678901234", 50, "Tecnologia", "Empresa XYZ", "Avcipal, 123");
        Cliente pessoa2 = new PessoaFisica("123456789", 560, 'F', "João da Sivs", "RuZ, 123");
        Cliente empresa2 = new PessoaJuridica("12345678901234", 5078, "Tecngia", "resa XYZ", "Av. cipal, 123");
        Conta contapj = new ContaCorrente(10000.0, 5789, "002", 200000.0, empresa1);
        Conta contapf = new ContaCorrente(1006660.0, 123456, "001", 500.0, pessoa2);
        Conta contapoup = new ContaPoupanca(10000666.0, 5789, "002", 200000.0, empresa2);
        Conta contauni = new ContaUniversitaria(10000666.0, 5789, "002", 200000.0, empresa2);

        System.out.println("ContaPJ");
        contapj.depositar(10000);
        contapj.sacar(10);
        contapj.sacar(1);
        contapj.sacar(900);

        try {
            Thread.sleep(5000); // pausa de 5 segundos
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        contapj.depositar(20);
        contapj.sacar(20);
        System.out.println("Ordenado por tipo de operação");
        contapj.imprimirExtrato(1);
        System.out.println("Ordenado por data");
        contapj.imprimirExtrato(0);
        System.out.println("Exemplo de caso de flag inválido");
        contapj.imprimirExtrato(10);

    }
}
