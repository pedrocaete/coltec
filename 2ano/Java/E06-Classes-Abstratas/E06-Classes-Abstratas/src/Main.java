
public class Main {

    public static void main(String[] args) {
        Cliente pessoa1 = new PessoaFisica("123456789", 30, 'M', "João da Silva", "Rua XYZ, 123");
        Cliente empresa1 = new PessoaJuridica("12345678901234", 50, "Tecnologia", "Empresa XYZ", "Avcipal, 123");
        Cliente pessoa2 = new PessoaFisica("123456789", 560, 'F', "João da Sivs", "RuZ, 123");
        Cliente empresa2 = new PessoaJuridica("12345678901234", 5078, "Tecngia", "resa XYZ", "Av. cipal, 123");
        Conta contapj = new ContaCorrente(10000.0, 5789, "002", 200000.0,empresa1);
        Conta contapf2 = new ContaUniversitaria(1006660.0, 123456, "001", 500.0, pessoa2);
        Conta contapj2 = new ContaPoupanca(10000666.0, 5789, "002", 200000.0,empresa2);

        if(pessoa1.autenticar("12456789"))
            System.out.println("Autentico");
        else
            System.out.println("Não autenticado");

        if(empresa1.autenticar("12345678901234"))
            System.out.println("Autentico");
        else
            System.out.println("Não autenticado");

    }
}
